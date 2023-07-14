<div class="row g-3">

    @livewire('inner.sidebar')

    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            Customer Support
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-info  px-3 btn-sm py-1" href="{{ url('customer-support/add-complaint') }}">Add New
                            Ticket</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm  table-striped  ">

                    <tr class="bg-light fs-12px ">
                        <th class="text-gray fw-normal ps-5">ID</th>
                        <th class="text-gray fw-normal">TYPE</th>
                        <th class="text-gray fw-normal">STATUS</th>
                        <th class="text-gray fw-normal"></th>
                    </tr>


                    @foreach($complaints_data as $complaints)
                        <tr class="fs-16px">
                            <td class="ps-5 align-middle ">{{ $complaints->id }}</td>
                            <td class="  align-middle "> {{ $complaints->option->name }}
                                <br> {{ $complaints->description }}</td>

                            <td class=" align-middle ">
                                @if($complaints->status == 'open')
                                    <span class="badge fs-16px bg-danger">{{ ucwords($complaints->status) }}</span>
                                @else
                                    <span class="badge fs-16px bg-success">{{ ucwords($complaints->status) }}</span>
                                @endif
                            </td>
                            <td class="px-4  align-middle text-end ">

                                <a class="btn btn-light fs-12px px-5 py-1"
                                   href="{{ url('customer-support/details/') }}/{{ $complaints->id }}">

                                    View
                                </a>

                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>

    </div>
</div>