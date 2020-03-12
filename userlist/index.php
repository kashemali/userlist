<?php
/*
* Name: UserList
*/
function geturl($f_url){
  return $f_url;
}
?>
<!DOCTYPE html>

<html>

<head>
	<title>Users List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=5.0" />
   <base href="userfetch"
	<link rel="stylesheet" href="<?php echo geturl('style.css');?>">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script src="<?php echo geturl('common.js');?>"></script>

<div >
	<table id="userlist" style="width: 100%;">
		<caption><h1>Users List</h1> <a onclick="filteruser();">Refresh</a></caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Website</th>
        <th>Action</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>
	<script>
    var endpoint = "<?php echo geturl("endpoint/");?>";
    
		
		function filteruser() {
			$.ajax({
				url: endpoint,
				dataType: 'json',
				success: function(json) {
					$.map(json, function(item) {
						item['class'] = "user" + item.id;
						var html = sprint(`<tr class="{class}">
						<td align="center">{id}</td>
						<td align="center">{name}</td>
						<td align="center">{username}</td>
						<td align="center">{email}</td>
						<td align="center">{phone}</td>
						<td align="center">{website}</td>
						<td align="center">
							  <a onclick="view({id});">View</a>
						</td>
					</tr>`, item);
            
						$('#userlist .' + item['class']).remove();
						$('#userlist tbody').append(html);
					});
				}
			});
		}filteruser();
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
               $('<div/>').dialog({title:"User Information",show: "slideDown",
		hide: "slideUp"}).prepend(html);
            }
        });
    }
     
	</script>
</body>

</html>