baseUrl = window.origin;
document.addEventListener("DOMContentLoaded", function() {
application_id = $('#application_id').val();
package_name = $('#package_name').val();

var text1 = baseUrl+"/api/add-token/"+application_id+'/'+package_name;
$('#url_1').text(text1)

var text2 = baseUrl+"/api/feedback/"+application_id;
$('#url_2').text(text2);
});
