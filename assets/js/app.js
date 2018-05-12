// loads the jquery package from node_modules
var $ = require('jquery');
require( 'datatables.net-bs4' )(window, $);
require( 'datatables.net-responsive-bs4' )(window, $);
require('../scss/app.scss');
require('../css/app.css');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');
$(document).ready( function () {
    $('#table_id').DataTable({
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Next",
                "previous":   "Previous"
            }
        }
    });
} );