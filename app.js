var dialog_options =
  {
    modal: true,
    resizable: false,
    draggable: false

  };
var no_close = Object.assign(dialog_options, { closeOnEscape: false })
angular.module('sortApp', [])

  .controller('mainController', ['$scope', '$http', function ($scope, $http) {
    this.dirty = false;
    var c = this;
    $scope.sortType = 'name'; // set the default sort type
    $scope.sortReverse = false;  // set the default sort order
    $scope.search = '';     // set the default search/filter term

    // get stuff from database
    $http.get("get.php").then(function (response) {
      $scope.classes = response.data;
    }, function (err) {
      $("<div>An error Occurred!</div>").dialog(dialog_options)
    })

    $scope.addClass = function () {
      $scope.classes.push({ name: $scope.newName, code: $scope.newCode, professor: $scope.newInstructor })
      $scope.newName = "";
      $scope.newCode = "";
      $scope.newInstructor = "";
      $("#addForm").dialog("close");
      c.dirty = true;
    }

    this.showAdd = function () {
      $("#addForm").dialog(dialog_options)
    }

    this.commit = function () {
      $("#loading").dialog(no_close)
      console.log(JSON.stringify($scope.classes))

      var data = { "json_data": JSON.stringify($scope.classes) }
      var url = "commit.php?" + $.param(data);
      console.log(url)
      $http.get(url).then(function (response) {
        $("#loading").dialog("close")
        $("<div>Commit Successful!</div>").dialog(dialog_options)
        c.dirty = false;
      }, function (err) {
        $("#loading").dialog("close")
        $("<div>An error Occurred!</div>").dialog(dialog_options)
      })
    }

    this.delete = function (idx) {
      $scope.classes.splice(idx, 1);
      this.dirty = true;
    }

  }]);