var photo_select = function (data) {
    var initTable = function (data) {
    	var ajax_url="";
		console.log(data);

        var table = jQuery('#photo_table');
        var ta =  table.DataTable({
            "sAjaxSource": ajax_url = "http://localhost/wp-content/themes/jupiter/assets/js/photo-table.php?book="+data,
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "START to END of TOTAL entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from MAX total entries)",
                "lengthMenu": "Show MENU entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            //"iDisplayLength":5,
            "language": {
                "lengthMenu": " MENU records",
                "paging": {
                    "previous": "Prev",
                    "next": "Next"
                }
            },
            "bProcessing": true,
            "aoColumns":[
                { "mData":'thumbnail',
                    'mRender':function(data, type,row){
                        return "<img src='"+data+"' style='width:40px; border-radius:50%;'>";
                    }
                },
                { "mData":'file_name' },
                {
                    "mData": 'photo_id',
                    'mRender':function(data,type,row){
                        return "<input type='checkbox' class='stream' name='"+data+"' data-id='"+data+"'>";
                        // return "<a href='developer_edit.php?user="+data+"'>Edit</a>";
                    }
                }
            ]
        });
    }
    return {
        init: function (data) {
            initTable(data);
        }
    };
}();
