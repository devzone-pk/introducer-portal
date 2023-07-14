<div class="row g-3">

    @livewire('inner.sidebar')
    <div class="col-md-9 col-12">
        <div class="card card-border border-primary shadow-light-lg mb-6">
            <div class="card-header px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Heading -->
                        <h4 class="mb-0">
                            All Receivers
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-info px-5 py-1" href="{{url('/recipients/add')}}">Add New</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm  table-striped  ">
                    <tr class="bg-light fs-12px ">
                        <th class="text-gray fw-normal ps-5">ID</th>
                        <th class="text-gray fw-normal">DESCRIPTION</th>
                        <th class="text-gray fw-normal">PHONE</th>
                        <th class="text-gray fw-normal">RELATION</th>
                        <th class="text-gray fw-normal"></th>
                    </tr>
                    @foreach($beneficiary as $key => $b)
                        <tr class="fs-16px">
                            <td class="ps-5 align-middle ">{{ $key + 1 }}</td>
                            <td class="  align-middle "> {{ $b->first_name }} {{ $b->last_name }}
                                <br> {{ $b->country }}</td>

                            <td class=" align-middle  ">
                                {{ $b->phone }}
                            </td>
                            <td class="align-middle  ">
                                {{ $b->relation }}
                            </td>
                            <td class="px-4  align-middle text-end ">

                                {{--                            <button class="btn p-0" id="open-meni">--}}
                                {{--                                <svg width="5" height="23" viewBox="0 0 5 23" fill="none"--}}
                                {{--                                     xmlns="http://www.w3.org/2000/svg">--}}
                                {{--                                    <circle cx="2.5" cy="2.5" r="2.5" fill="#ABBCD5"/>--}}
                                {{--                                    <circle cx="2.5" cy="11.5" r="2.5" fill="#ABBCD5"/>--}}
                                {{--                                    <circle cx="2.5" cy="20.5" r="2.5" fill="#ABBCD5"/>--}}
                                {{--                                </svg>--}}
                                {{--                            </button>--}}

                                <div class="dropdown show">
                                    <a class="btn" href="#" role="button" id="dropdownMenuLink"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg width="5" height="23" viewBox="0 0 5 23" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="2.5" cy="2.5" r="2.5" fill="#ABBCD5"/>
                                            <circle cx="2.5" cy="11.5" r="2.5" fill="#ABBCD5"/>
                                            <circle cx="2.5" cy="20.5" r="2.5" fill="#ABBCD5"/>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{url('recipients/view',$b->id)}}">View</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        $('.dropdown-toggle').dropdown()
    </script>
</div>
