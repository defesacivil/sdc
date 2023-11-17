<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	
	<!-- Awesome Theme -->
	<!-- <link rel="stylesheet" href="css/awesomeStyle/awesome.css" /> -->
	<!-- Awesome Theme -->
	<!-- <link rel="stylesheet" href="css/metroStyle/metroStyle.css" /> -->
	<!-- Awesome Theme -->
	<link rel="stylesheet" href="css/zTreeStyle/zTreeStyle.css" />

</head>
<body>



	<ul id="treeDemo" class="ztree"></ul>



	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->


	<!-- jQuery is required -->
	<script src="js/jquery-1.4.4.min.js"></script>

	<!-- Core JavaScript -->
	<script src="js/jquery.ztree.all.min.js"></script>
	<!-- Checkbox Plugin -->

	<!-- Show/Hide Plugin -->

	<!-- OR ALL IN ONE -->
	<!-- <script src="/path/to/js/jquery.ztree.all.min.js"></script>
		<script type="text/javascript" src="js/jquery.ztree.all.js"></script> -->
		<script type="text/javascript">

				var setting = {
					data: {
						simpleData: {
							enable: true
						}
					}
				};

				var zNodes =[
				{ 
					id:1,
					pId:0,
					name:"Custom Icon 01",
					open:true,
					iconOpen:"css/zTreeStyle/img/diy/1_open.png",
					iconClose:"css/zTreeStyle/img/diy/1_close.png"
				},
				{ id:11, pId:1, name:"leaf node 01", icon:"css/zTreeStyle/img/diy/2.png"},
				{ id:12, pId:1, name:"leaf node 02", icon:"css/zTreeStyle/img/diy/3.png"},
				{ id:13, pId:1, name:"leaf node 03", icon:"css/zTreeStyle/img/diy/5.png"},
				{ id:2, pId:0, name:"Custom Icon 02", open:true, icon:"css/zTreeStyle/img/diy/4.png"},
				{ id:21, pId:2, name:"leaf node 01", icon:"css/zTreeStyle/img/diy/6.png"},
				{ id:22, pId:2, name:"leaf node 02", icon:"css/zTreeStyle/img/diy/7.png"},
				{ id:23, pId:2, name:"leaf node 03", icon:"css/zTreeStyle/img/diy/8.png"},
				{ id:3, pId:0, name:"no Custom Icon", open:true },
				{ id:31, pId:3, name:"leaf node 01"},
				{ id:32, pId:3, name:"leaf node 02"},
				{ id:33, pId:3, name:"leaf node 03"}

				];

				$(document).ready(function(){
					$.fn.zTree.init($("#treeDemo"), setting, zNodes);
				});



			</script>
		</body>
		</html>