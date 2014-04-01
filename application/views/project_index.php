<!DOCTYPE html>
<html ng-app="todoApp">
<head>
  <title>RUBY GARAGE TODO LIST</title>
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/ci/styles/style.css">
</head>
<body ng-controller="projectController">
  <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-primary" ng-repeat="project in projects">
                    <div class="panel-heading">
                      <div class="panel-title">
                      <div class="row">
                        <div class="col-md-1 list text-center">
                          <i class="glyphicon glyphicon-list-alt"></i>  
                        </div>
                        <div class="col-md-10">
                            <a data-toggle="collapse" class="project-name" href="#collapse{{$index}}">
                              {{project.Name}}
                            </a>
                        </div>
                        <div class="col-md-1">
                            <div class="btn-group btn-group-xs pull-right btn-project-group">
                                <a class="btn" href="#" data-toggle="modal" data-target="#project-editor-window" title="edit" ng-click="edit($index)">
                                    <i class="glyphicon glyphicon-pencil"></i>    
                                </a>
                                <a class="btn" href="#" title="remove" ng-click="remove($index)">
                                    <i class="glyphicon glyphicon-trash"></i>    
                                </a>
                            </div>
                        </div>
                       </div>
                      </div>
                    </div>
                    <div class="panel-collapse collapse in" id="collapse{{$index}}">
                      <div class="panel-body project-tasks" ng-controller="taskController" ng-init="init(project.Id)">
                          
                          <!-- Task Bar -->
                            <nav class="navbar navbar-default" role="navigation">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#task-navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="task-navbar">
                                  <form class="navbar-form" role="search">
                                    <div class="form-group">
                                        <div class="col-sm-1 task-plus text-center">
                                            <i class="glyphicon glyphicon-plus text-success"></i>
                                        </div>
                                        <div class="col-sm-11">
                                            <div class="input-group">
                                              <input type="text" class="form-control" placeholder="Start typing here to create a task..." ng-model="editableTask.Name" ng-value="editableTask.Name" />
                                              <span class="input-group-btn">
                                                  <button class="btn btn-success" ng-click="update()">Add Task</button>    
                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                  </form>
                                </div><!-- /.navbar-collapse -->
                            </nav>
                            <!-- /Task  Bar -->
                            <!-- Tasks -->
                            <div class="container-fluid">
                             <!-- ko if: tasks() -->
                                <ul class="nav list-group-tasks">
                                    <li class="row" ng-repeat="task in tasks | orderBy:'-Priority' ">
                                        <div class="col-xs-1 checked-flag">
                                            <div class="checkbox center-block">
                                                <input type="checkbox" ng-change="done($index)" ng-checked="tasks[$index].Status == 1" ng-model="tasks[$index].Status">
                                            </div>
                                        </div>
                                        <div class="col-xs-10">
                                            <div class="container-fluid task-name">
                                                <div class="checkbox">
                                                    {{task.Name}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-1 task-controls">
                                            <div class="checkbox">
                                                <div class="btn-toolbar btn-group-tasks">
                                                    <div class="btn-group btn-group-vertical btn-group-xs">
                                                        <a href="#" class="btn" title="PriorityUp" ng-click="changePriority($index,1)">
                                                            <i class="glyphicon glyphicon-chevron-up"></i>
                                                        </a>
                                                        <a href="#" class="btn" title="PriorityDown" ng-click="changePriority($index,-1)">
                                                            <i class="glyphicon glyphicon-chevron-down"></i>
                                                        </a>
                                                    </div>
                                                    <div class="btn-group btn-group-xs btns-task-control">
                                                        <a class="btn" href="#" title="Edit" ng-click="edit($index)">
                                                            <i class="glyphicon glyphicon-pencil"></i>    
                                                        </a>
                                                        <a class="btn" href="#" title="Remove" ng-click="remove($index)">
                                                            <i class="glyphicon glyphicon-trash"></i>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                             <!-- /ko -->
                            </div>
                            <!-- /Tasks-->



                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
            <button class="btn btn-primary btn-block center-block" ng-click="showWindow()">
                <i class="glyphicon glyphicon-plus"></i>
                Add TODO List
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="project-editor-window">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Project</h4>
      </div>
      <div class="modal-body">
        <form action="#" class="form form-horizontal" role="form">
            <fieldset>
                <div class="form-group">
                    <label for="projectName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" id="projectName" name="projectName" class="form-control" ng-model="editableProject.Name" ng-value="editableProject.Name">
                    </div>
                </div>
            </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="update()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
<script type="text/javascript" src="/ci/js/projectController.js"></script>
<script type="text/javascript" src="/ci/js/taskController.js"></script>
<script type="text/javascript" src="/ci/js/app.js"></script>


</body>
</html>