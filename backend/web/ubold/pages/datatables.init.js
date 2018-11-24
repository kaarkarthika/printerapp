/**
 * Theme: Ubold Admin Template
 * Author: Coderthemes
 * Component: Datatable
 * 
 */
var handleDataTableButtons = function() {
        "use strict";
        0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
        
            buttons: [{
                extend: "copy",
                className: "btn-sm"
            }, {
                extend: "csv",
                className: "btn-sm"
            }, {
                extend: "excel",
                className: "btn-sm"
            }, {
                extend: "pdf",
                className: "btn-sm"
            }, {
                extend: "print",
                className: "btn-sm"
            }],
            
          
            responsive: !0,
            lengthMenu: [[3,10, 25, 50, -1], [3,10, 25, 50, "All"]],
            "paging": true,
            scrollX:false,
            
        })
    },
    TableManageButtons = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableButtons()
            }
        }
    }();