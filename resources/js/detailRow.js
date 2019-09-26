$(document).ready(function() {
	var parentsData = ;

      var $table = $('.js-table');

      $table.find('.js-view-parents').on('click', function(e) {
        e.preventDefault();
        var $btn = $(e.target), $row = $btn.closest('tr'), $nextRow = $row.next('tr.expand-child');

        $btn.toggleClass('glyphicon-eye-close glyphicon-eye-open');
        // if .expand-chid row exist already, toggle
        if ($nextRow.length) {
            $nextRow.toggle($btn.hasClass('glyphicon-eye-open'));
        // if not, create .expand-child row
        } else {
          /*$.ajax({
              url: '/echo/json/',
              dataType: "json",
              data: parentsData,
              success: function (parentsData) {*/
          var newRow = '<tr class="expand-child" id="collapse' + $btn.data('id') + '">' +
            '<td colspan="12">' +
            '<table class="table table-condensed table-bordered" width=100% >' +
            '<thead>' +
            '<tr>' +
            '<th>Surname</th>' +
            '<th>FirstName</th>' +
            '<th>School Id</th>' +
            '<th>School name</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>';

          if (parentsData.parents) {
            $.each(parentsData.parents, function(i, parent) {
              newRow += '<tr>' +
                '<td>' + parent.Firstname + '</td>' +
                '<td>' + parent.Surname + '</td>' +
                '<td>' + parent.schoolId + '</td>' +
                '<td>' + parent.schoolName + ' ' + parent.commune + '</td>' +
                '</tr>';
            });
          }
          newRow += '</tbody></table></td></tr>';
          // set next row
          $nextRow = $(newRow).insertAfter($row);


          /*}
              });*/
        }
      });


});
