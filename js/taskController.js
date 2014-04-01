function TaskController($scope){
	$scope.tasks = [];
	$scope.editIndex = -1;
	$scope.ProjectId = 0;
	$scope.editableTask ={
		Id : 0,
		Name : '',
		Status: false,
		Priority : 0,
		ProjectId : 0
	};
	
	$scope.init = function(id){
		$scope.ProjectId = id;
		$scope.editableTask.ProjectId = id;
		$.ajax({
			url: '/ci/index.php/task/all',
			type:'get',
			data:{
				ProjectId : id
			},
			success:function(responce){
				if(responce != null && responce != undefined && responce.length > 0)
					$scope.$apply(function(){
						$scope.tasks = responce
					});
			}
		});
	};

	$scope.done = function(index){
		var task = $scope.tasks[index];
		var item = {
			Id : task.Id,
			Name : task.Name,
			Status : task.Status==true?1:0,
			ProjectId : task.ProjectId,
			Priority : task.Priority
		};
		$.ajax({
			url: '/ci/index.php/task/update',
			type:'post',
			data: item,
			success:function(result){
				// if(result == true)
					// $scope.$apply(function(){
					// 	$scope.tasks[index].Status = item.Status;
					// });
			}
		});
	};
	$scope.changePriority = function(index,value){
		var task = $scope.tasks[index];
		var item = {
			Id : task.Id,
			Name : task.Name,
			Status : task.Status,
			ProjectId : task.ProjectId,
			Priority : parseInt(task.Priority) + value
		};

		$.ajax({
			url: '/ci/index.php/task/update',
			type:'post',
			data: item,
			success:function(result){
				if(result == true)
					$scope.$apply(function(){
						$scope.tasks[index].Priority = item.Priority;
					});
			}
		});
	}
	$scope.update = function(){
		$.ajax({
			url: $scope.editableTask.Id == 0 ? '/ci/index.php/task/insert' : '/ci/index.php/task/update',
			type:'post',
			data:$scope.editableTask,
			success:function(responce){
				if($scope.editableTask.Id == 0 && responce > 0)
				{
					var task = {
						Id : responce,
						Name : $scope.editableTask.Name,
						Status : $scope.editableTask.Status,
						Priority : $scope.editableTask.Priority,
						ProjectId : $scope.editableTask.ProjectId
					};
					$scope.$apply(function(){
						$scope.tasks.push(task);	
					});
				}
				if($scope.editableTask.Id != 0){
					$scope.$apply(function(){
						$scope.tasks[$scope.editIndex].Name = $scope.editableTask.Name;
					});
				}
				$scope.editableTask.Name = '';
				$scope.editableTask.Id = 0;
				$scope.editableTask.Priority = 0;
				$scope.editableTask.Status = 0;
				$scope.editIndex = -1;
			}
		});
	};

	// behavior 
	$scope.remove = function(index){
		var item = $scope.tasks[index];
		$.ajax({
			url: '/ci/index.php/task/remove',
			type:'post',
			data:{
				Id : item.Id
			},
			success:function(result){
				if(result == true)
					$scope.$apply(function(){
						$scope.tasks.splice(index, 1);
					});
			}
		})
	};

	$scope.edit = function(index){
		var item = $scope.tasks[index];
		$scope.editableTask.Name = item.Name;
		$scope.editableTask.Id = item.Id;
		$scope.editableTask.Priority = item.Priority;
		$scope.editableTask.Status = item.Status;
		$scope.editIndex = index;
	};

}