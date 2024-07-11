<ul class="pagination">
    <li ng-if="directionLinks" ng-class="{ disabled : pagination.current == 1 }" class="ng-scope page-item">
        <a href="javascript:;" ng-click="setCurrent(pagination.current - 1)" class="ng-binding page-link">&laquo;
            Previous</a>
    </li>
    <li ng-repeat="pageNumber in pages track by $index"
        ng-class="{ active : pagination.current == pageNumber, disabled : pageNumber == '...' }" class="page-item">
        <a href="javascript:;" ng-click="setCurrent(pageNumber)" class="page-link">@{{ pageNumber }}</a>
    </li>

    <li ng-if="directionLinks" ng-class="{ disabled : pagination.current == pagination.last }"
        class="ng-scope page-item">
        <a href="javascript:;" ng-click="setCurrent(pagination.current + 1)" class="ng-binding page-link">Next
            &raquo;</a>
    </li>
</ul>
