function ProjectController($scope){
	$scope.projects = [];
	$scope.editableProject = {
		Id : 0,
		Name : ''
	};
	$scope.EditIndex = -1;
	// init 
	$.ajax({
		url: '/ci/index.php/project/all',
		type:'get',
		success:function(responce){
			if(responce != null && responce != undefined && responce.length > 0)
				$scope.$apply(function(){
					$scope.projects = responce
				});
		}
	});

	// behavior 
	$scope.remove = function(index){
		var item = $scope.projects[index];
		$.ajax({
			url: '/ci/index.php/project/remove',
			type:'post',
			data:{
				Id : item.Id
			},
			success:function(result){
				if(result == true)
					$scope.$apply(function(){
						$scope.projects.splice(index, 1);
					});
			}
		})
	};

	$scope.showWindow = function(){
		$('#project-editor-window').modal('show');
	};
	$scope.edit = function(index){
		var item = $scope.projects[index];
		$scope.editableProject.Name = item.Name;
		$scope.editableProject.Id = item.Id;
		$scope.showWindow();
		$scope.editIndex = index;
	};
	$scope.update = function(){
		$.ajax({
			url: $scope.editableProject.Id == 0 ? '/ci/index.php/project/insert' : '/ci/index.php/project/update',
			type:'post',
			data:$scope.editableProject,
			success:function(responce){
				if($scope.editableProject.Id == 0 && responce > 0)
				{
					var project = {
						Id : responce,
						Name : $scope.editableProject.Name
					};
					$scope.$apply(function(){
						$scope.projects.push(project);	
					});
				}
				if($scope.editableProject.Id != 0){
					$scope.$apply(function(){
						$scope.projects[$scope.editIndex].Name = $scope.editableProject.Name;
					});
				}
				$scope.editableProject.Name = '';
				$scope.editableProject.Id = 0;
				$scope.editIndex = -1;
			}
		});
	};


}