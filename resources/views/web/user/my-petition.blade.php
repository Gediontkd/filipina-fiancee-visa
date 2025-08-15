@extends('web.layout.master')
@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    {{getLanguage()}}
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4  mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title">My Petition</h2>
                    </div>
                     <div class="card-body p-3">                        
                        <div class="table-responsive">
                            @if (!empty($steps))
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                   
                                        {{-- @foreach ($steps as $step) --}}
                                            <tr>
                                                <td>{{ @$steps->application }}</td>              
                                                <td>{{ @$steps->created_at }}</td>                       
                                            </tr>
                                        {{-- @endforeach                                    --}}
                                    </tbody>
                                </table>
                                <tfoot>
                                    {{-- <div class="pagination-section">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $steps->previousPageUrl() }}" aria-label="Previous">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
                                                    <polyline points="15 18 9 12 15 6"></polyline>
                                                </svg>
                                                </a>
                                            </li>
                                            @for ($page = 1; $page <= $steps->lastPage(); $page++)
                                                <li class="page-item {{ $page ==  $steps->currentPage() ? 'active' : ''}}">                           
                                                    <a class="page-link" href="{{ $steps->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $steps->nextPageUrl() }}" aria-label="Next">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    </div> --}}
                                </tfoot>
                            @else
                                No Petition Found!
                            @endif
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
@endsection
@section('customScript')
<script type="text/javascript">
	
</script>
@endsection