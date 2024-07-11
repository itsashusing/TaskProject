<link href="{{ asset('public/assets/css/preloader.style.css') }}" rel="stylesheet" />
<div class="row justify-content-between my-2">
    <div class="col-1">
        <label class="form-label">Show</label>
        <select class="form-select" style="width: 130%;" ng-model="usersPerPage" ng-change="updatePerPage()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    <div class="col-3 float-right">
        <label for="search" class="form-label">Search</label>
        <input type="text" class="form-control" ng-model="q" ng-change="searchFilter()" id="search">
    </div>
    <div ng-if="showPreloader">
        <div id="preloader">
            <div class="spinner"></div>
        </div>
    </div>
</div>
