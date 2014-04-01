var todoApp = angular.module('todoApp', []);

//todoApp.addValue('rootUrlProject','/index.php/');

todoApp.controller('projectController',ProjectController);
todoApp.controller('taskController',TaskController);