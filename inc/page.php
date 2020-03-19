<?php
/**
 * User List Page
 */

require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
function geturl($f_url){
  return esc_url( plugins_url( $f_url, dirname(__FILE__) ));
}

?>



<div >
	<table class="usertable" id="userlist" style="width: 100%;">
		<caption><h1>Users List</h1> <a class="refresh">Refresh</a></caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Website</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>
	<script>
    jQuery(document).ready(function(){
    var endpoint = "<?php echo geturl("./");?>";
		function filteruser() {
			$.ajax({
				url: endpoint+"?all=1",
				dataType: 'json',
				success: function(json) {
					$.map(json, function(item) {
						item['class'] = "user" + item.id;
						var html = sprint(`<tr class="{class}">
						<td align="center" label="ID" ><a class="view" data-id="{id}">{id}</a></td>
						<td align="center" label="Name"><a class="view" data-id="{id}">{name}</a></td>
						<td align="center" label="Username"><a class="view" data-id="{id}">{username}</a></td>
						<td align="center" label="Email">{email}</td>
						<td align="center" label="Phone">{phone}</td>
						<td align="center" label="website">{website}</td>
						
					</tr>`, item);
            
						$('#userlist .' + item['class']).remove();
						$('#userlist tbody').append(html);
					});
				}
			});
		}filteruser();
     var last;
    function view(id) {
              $.ajax({
            dataType: "json",
            url: endpoint+"?id="+id,
            success: function(json){     
               html=sprint(`<table class="table table-bordered table-striped">
               <tr><td>ID:</td><td>{id}</td></tr>
               <tr><td>Name:</td><td>{name}</td></tr>
               <tr><td>UserName:</td><td>{username}</td></tr>
               <tr><td>Email:</td><td>{email}</td></tr>
               <tr><td>Phone:</td><td>{phone}</td></tr>
               <tr><td>Website:</td><td>{website}</td></tr>
               </table>`,json);
               if (last) {
                   $(last).dialog('destroy');
               }
                last=$('<div/>').dialog({title:"User Information",show: "slideDown",
		hide: "slideUp"}).prepend(html);
            }
        });
    }
     $('.refresh').click(function(){
      filteruser();
     });
     $(document).off().on('click','.view',function(){
      view($(this).data("id"));
     });
    });
	</script>
<?php //include( ABSPATH . 'wp-admin/admin-footer.php' );?>