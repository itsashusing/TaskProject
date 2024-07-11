<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @include('header_link')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="mb-0 text-uppercase">{{ $page_data['page_title'] }}</h6>
                        </div>
                        <div class="col-6 text-end px-0 px-lg-3">
                            <button type="button"
                                onclick="ajaxModal('{{ url('ajaxModal/modal_files.add_task') }}', sendObj({'_token' : '{{ csrf_token() }}'}))"
                                class="btn btn-primary btn-sm px-3"><i class='bx bx-plus'></i>Add New Task</button>
                        </div>
                    </div>
                    <hr />

                    <div class="card" ng-app="paginationApp" ng-controller="paginationController">
                        <div class="card-body">
                            @include('components.pagination-header')
                            <div class="table-responsive">
                                <table class="table no-footer" style="width:100%; border: 1px solid #e9ecef">
                                    <thead class="table-light">
                                        <tr id="thead-html">
                                            <th>S no.</th>
                                            <th>Task Name </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr dir-paginate="item in users | filter: q | itemsPerPage: usersPerPage"
                                            total-items="totalUsers" current-page="pagination.current">
                                            <td>@{{ getSerialNumber($index) }}</td>

                                            <td>@{{ item.task }}</td>
                                            <td>
                                                <span ng-if="item.status == 1"
                                                    class="badge rounded-pill bg-success">Completed</span>
                                                <span ng-if="item.status == 0"
                                                    class="badge rounded-pill bg-warning">Pending</span>
                                            </td>

                                            <td>
                                                <div class="dropdown dropstart d-flex order-actions">
                                                    <a href="javascript:;" class="mx-1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="py-1">
                                                            <a class="dropdown-item px-3"
                                                                style="all: unset; cursor: pointer;"
                                                                href="{{ route('user.add_task') }}/change_status/@{{ item.id }}">@{{
                                                                item.status == 1 ? "Mark as incomplete" : "Mark as
                                                                Complete"
                                                                }}</a>
                                                        </li>

                                                        <li class="py-1 " ng-if="item.status == 0">
                                                            <a href="javascript:;" class="dropdown-item px-3"
                                                                style="all: unset; cursor: pointer;"
                                                                ng-click="ajaxModal('{{ url('ajaxModal/modal_files.edit_task') }}', sendObj({'_token' : '{{ csrf_token() }}', 'id' : item.id}))">Edit</a>
                                                        </li>
                                                        <li class="py-1">
                                                            <form action="{{ route('user.add_task') }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="text" name="id" hidden
                                                                    value="@{{ item.id }}">
                                                                <button style="all: unset; cursor: pointer;"
                                                                    class="dropdown-item px-3">Delete</button>
                                                            </form>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr ng-if="totalUsers <= 0">
                                            <td id="no-data">
                                                <div class="text-center">No data available in table</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @include('components.pagination-footer')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('toaster')
    @include('footer_link')
    @include('poups_modal')

</x-app-layout>