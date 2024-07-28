//******************************************************************************
// Filename:    datatables.js
// Author:      Zachary Abela-Gale <abel1325@pacificu.edu>
// Date:        2024/07/27
// Purpose:     Common JS functions used with datatables.
//******************************************************************************
// Not in use yet. Pending further understanding of asset system and it's integration with AdminLTE.

export function linkDeleteButton(dataType, dataID, route, CSRF) {
  $('.btn-delete').click(function (e) {
    e.preventDefault();
    if (confirm('Are you sure you want to delete this ' + dataType + '?')) {
      $.ajax({
        url: route + $(this).data(dataID),
        method: 'POST',
        data: {
          _token: CSRF,
          _method: 'DELETE'
        },
        success: function (response) {
          location.reload();
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }
  });
}