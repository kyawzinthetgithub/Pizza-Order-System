@extends('admin.layout.master')

@section('title', 'Customer Contact')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <span class="me-2">Customer Message </span>{{ $details->id }}
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row mb-2">
                                                <div class="col-1">
                                                    <i class="fa-solid fa-id-badge"></i>
                                                </div>
                                                <div class="col">
                                                    {{ $details->name }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fa-solid fa-at"></i>
                                                </div>
                                                <div class="col">
                                                    {{ $details->email }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">

                                            <h6 class="card-subtitle mb-2 text-body-secondary">What Customer Say ?</h6>
                                            <p class="card-text">{{ $details->message }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-end me-5">
                                                <a href="{{ route('admin#userMessage') }}" class="card-link text-black"><i
                                                        class="fa-solid fa-circle-arrow-left"></i></a>
                                                <a href="{{ route('admin#deleteMessage', $details->id) }}"
                                                    class="card-link text-danger"><i class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
