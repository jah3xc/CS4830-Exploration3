<!DOCTYPE html>
<html>

<head>
  <title>Exploration 3: Angular with Postgres</title>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Jquery and Jquery UI -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <!-- Boostrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--Angular-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <!--Font Awesome-->
    <script src="https://use.fontawesome.com/d7c244fd28.js"></script>

  <script src="app.js"></script>
  <script>
    $(function () {
      $('input').addClass("form-control");
      $('label').addClass("control-label");
    });
  </script>
</head>

<body>
  <div class="container" ng-app="sortApp" ng-controller="mainController as ctrl">

    <br><br><br>
    <h1 class="text-center">Exploration 3</h1>
    <form>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-search"></i></div>
          <input type="text" class="form-control" placeholder="Search Classes" ng-model="search">
        </div>
      </div>
    </form>
    <div class="col-md-offset-9 col-md-3 text-right">
      <button class="btn btn-primary" ng-click="ctrl.showAdd()">Add Class</button>
      <button class="btn btn-danger" ng-click="ctrl.commit()" ng-show="ctrl.dirty">Commit Changes</button>
    </div>
    <table class="table table-bordered table-striped">

      <thead>
        <tr>
          <td>
            <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
            Name
            <span ng-show="sortType == 'name' && !sortReverse" class="fa fa-caret-down"></span>
            <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
          </a>
          </td>
          <td>
            <a href="#" ng-click="sortType = 'code'; sortReverse = !sortReverse">
          Course Code
            <span ng-show="sortType == 'code' && !sortReverse" class="fa fa-caret-down"></span>
            <span ng-show="sortType == 'code' && sortReverse" class="fa fa-caret-up"></span>
          </a>
          </td>
          <td>
            <a href="#" ng-click="sortType = 'professor'; sortReverse = !sortReverse">
          Instructor
            <span ng-show="sortType == 'professor' && !sortReverse" class="fa fa-caret-down"></span>
            <span ng-show="sortType == 'professor' && sortReverse" class="fa fa-caret-up"></span>
          </a>
          </td>
        </tr>
      </thead>

      <tbody>
        <tr ng-repeat="c in classes | orderBy:sortType:sortReverse | filter:search">
          <td>{{ c.name }}</td>
          <td>{{ c.code }}</td>
          <td>{{ c.professor }}</td>
        </tr>
      </tbody>

    </table>
    <div id="addForm" hidden="hidden">
      <h3>Add A Class</h3>
      <form ng-submit="addClass()" class="form" name="newClassForm">
        <div class="form-group">
          <label>Name</label>
          <input ng-model="newName" required />
        </div>
        <div class="form-group">
          <label>Course Code</label>
          <input ng-model="newCode" required />
        </div>
        <div class="form-group">
          <label>Instructor</label>
          <input ng-model="newInstructor" required />
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" style="margin-top:20px;margin-left:15px;">Submit</button>
        </div>
      </form>
    </div>

    <div id="loading" hidden="hidden">
      Loading...Please wait
    </div>
  </div>

  
</body>

</html>