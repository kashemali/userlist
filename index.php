<?php
/*
* @Package: UserList
*/
$autoload_file=dirname(__FILE__)."/autoload.php";
if(file_exists($autoload_file)){
	require_once($autoload_file);
}
use Inc\EndpointUser;
$endpoint="https://jsonplaceholder.typicode.com/users/";
$users=new EndpointUser($endpoint);
if(!empty($_GET['id'])){
  echo $users->byId($_GET['id']);
  exit();
}
if(!empty($_GET['all'])){
  echo $users->all();
  exit();

}




function geturl($f_url){
  return $f_url;
}
?>
<!DOCTYPE html>

<html>

<head>
	<title>Users List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=5.0" />
	<link rel="stylesheet" href="<?php echo geturl('assets/style.css');?>">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script src="<?php echo geturl('assets/common.js');?>"></script>

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
</body>

</html>
