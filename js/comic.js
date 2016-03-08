$(function () { 
    $.getJSON( "table_json.php", function(data) {

    var obj = {
         width: 1300, 
         height: 500,
         editable: false,
         flexHeight:true,
         title: "Comics"};
    obj.colModel = [{ title: "Book", width: 200, dataType: "dataType", dataIndx: "Book" },
                       { title: "#0", width: 25, dataType: "string", dataIndx: "Book_0" },
                       { title: "#1", width: 25, dataType: "string", dataIndx: "Book_1" },
                       { title: "#2", width: 25, dataType: "string", dataIndx: "Book_2" },
                       { title: "#3", width: 25, dataType: "string", dataIndx: "Book_3" },
                       { title: "#4", width: 25, dataType: "string", dataIndx: "Book_4" },
                       { title: "#5", width: 25, dataType: "string", dataIndx: "Book_5" },
                       { title: "#6", width: 35, dataType: "string", dataIndx: "Book_6" },
                       { title: "#7", width: 35, dataType: "string", dataIndx: "Book_7" },
                       { title: "#8", width: 35, dataType: "string", dataIndx: "Book_8" },
                       { title: "#9", width: 35, dataType: "string", dataIndx: "Book_9" },
                       { title: "#10", width: 35, dataType: "string", dataIndx: "Book_10" },
                       { title: "#11", width: 35, dataType: "string", dataIndx: "Book_11" },
                       { title: "#12", width: 35, dataType: "string", dataIndx: "Book_12" },
                       { title: "#13", width: 35, dataType: "string", dataIndx: "Book_13" },
                       { title: "#14", width: 35, dataType: "string", dataIndx: "Book_14" },
                       { title: "#15", width: 35, dataType: "string", dataIndx: "Book_15" },
                       { title: "#16", width: 35, dataType: "string", dataIndx: "Book_16" },
                       { title: "#17", width: 35, dataType: "string", dataIndx: "Book_17" },
                       { title: "#18", width: 35, dataType: "string", dataIndx: "Book_18" },
                       { title: "#19", width: 35, dataType: "string", dataIndx: "Book_19" },
                       { title: "#20", width: 35, dataType: "string", dataIndx: "Book_20" },
                       { title: "#21", width: 35, dataType: "string", dataIndx: "Book_21" },
                       { title: "#22", width: 35, dataType: "string", dataIndx: "Book_22" },
                       { title: "#23", width: 35, dataType: "string", dataIndx: "Book_23" },
                       { title: "#24", width: 35, dataType: "string", dataIndx: "Book_24" },
                       { title: "#25", width: 35, dataType: "string", dataIndx: "Book_25" },
                       { title: "#26", width: 35, dataType: "string", dataIndx: "Book_26" },
                       { title: "#27", width: 35, dataType: "string", dataIndx: "Book_27" },
                       { title: "#28", width: 35, dataType: "string", dataIndx: "Book_28" },
                       { title: "#29", width: 35, dataType: "string", dataIndx: "Book_29" },
                       { title: "#30", width: 35, dataType: "string", dataIndx: "Book_30" },
                       { title: "Publisher", width: 150, dataType: "string", dataIndx: "Publisher"}];
    obj.dataModel = { data: data, location: "local", sorting: "local", paging: "local", curPage: 1, rPP: 20, sortIndx: "Book", sortDir: "up", rPPOptions: [5,10, 15, 25, 50, 100, 200, 500] };

    obj.colModel = obj.colModel;
 
    obj.colModel[0].width = 220;
    
    $("#grid_crud").on("pqgridrender", function (evt, obj) {
        var $toolbar = $("<div class='pq-grid-toolbar pq-grid-toolbar-crud'></div>").appendTo($(".pq-grid-top", this));
 
        $("<span>Add</span>").appendTo($toolbar).button({ icons: { primary: "ui-icon-circle-plus"} }).click(function (evt) {
            addRow();
        });
        $("<span>Edit</span>").appendTo($toolbar).button({ icons: { primary: "ui-icon-pencil"} }).click(function (evt) {
            editRow();
        });
        $("<span>Delete</span>").appendTo($toolbar).button({ icons: { primary: "ui-icon-circle-minus"} }).click(function () {
            deleteRow();
        });
        $toolbar.disableSelection();
    });    
    var $grid = $("#grid_crud").pqGrid(obj);

    //create popup dialog.
    $("#popup-dialog-crud").dialog({ width: 400, modal: true,
        open: function () { $(".ui-dialog").position({ of: "#grid_crud" }); },
        autoOpen: false
    });
    //edit Row
    function editRow() {
        var rowIndx = getRowIndx();
        if (rowIndx != null) {
            var DM = $grid.pqGrid("option", "dataModel");
            var data = DM.data;
            var row = data[rowIndx];
            var $frm = $("form#crud-form");
            $frm.find("input[name='company']").val(row[0]);
            $frm.find("input[name='symbol']").val(row[1]);
            $frm.find("input[name='price']").val(row[3]);
            $frm.find("input[name='change']").val(row[4]);
            $frm.find("input[name='pchange']").val(row[5]);
            $frm.find("input[name='volume']").val(row[6]);
 
            $("#popup-dialog-crud").dialog({ title: "Edit Record (" + (rowIndx + 1) + ")", buttons: {
                Update: function () {
                    //save the record in DM.data.
                    row[0] = $frm.find("input[name='company']").val();
                    row[1] = $frm.find("input[name='symbol']").val();
                    row[3] = $frm.find("input[name='price']").val();
                    row[4] = $frm.find("input[name='change']").val();
                    row[5] = $frm.find("input[name='pchange']").val();
                    row[6] = $frm.find("input[name='volume']").val();
                    //$grid.pqGrid("refreshDataAndView").pqGrid('setSelection',{ rowIndx:rowIndx});
                    $grid.pqGrid("refreshRow", { rowIndx: rowIndx }).pqGrid('setSelection', { rowIndx: rowIndx });
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
            }).dialog("open");
        }
    }
    //append Row
    function addRow() {
        //debugger;
        var DM = $grid.pqGrid("option", "dataModel");
        var data = DM.data;
 
        var $frm = $("form#crud-form");
        $frm.find("input").val("");
 
        $("#popup-dialog-crud").dialog({ title: "Add Record", buttons: {
            Add: function () {                    
                var row = [];
                //save the record in DM.data.
                row[0] = $frm.find("input[name='company']").val();
                row[1] = $frm.find("input[name='symbol']").val();
                row[3] = $frm.find("input[name='price']").val();
                row[4] = $frm.find("input[name='change']").val();
                row[5] = $frm.find("input[name='pchange']").val();
                row[6] = $frm.find("input[name='volume']").val();
                data.push(row);
                $grid.pqGrid("refreshDataAndView");
                $(this).dialog("close");
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }
        });
        $("#popup-dialog-crud").dialog("open");
    }
    //delete Row.
    function deleteRow() {
        var rowIndx = getRowIndx();
        if (rowIndx != null) {
            var DM = $grid.pqGrid("option", "dataModel");
            DM.data.splice(rowIndx, 1);
            $grid.pqGrid("refreshDataAndView");
            $grid.pqGrid("setSelection", { rowIndx: rowIndx });
        }
    }
    function getRowIndx() {
        //var $grid = $("#grid_render_cells");
 
        //var obj = $grid.pqGrid("getSelection");
        //debugger;
        var arr = $grid.pqGrid("selection", { type: 'row', method: 'getSelection' });
        if (arr && arr.length > 0) {
            var rowIndx = arr[0].rowIndx;
 
            //if (rowIndx != null && colIndx == null) {
            return rowIndx;
        }
        else {
            alert("Select a row.");
            return null;
        }
    }

    });
});