@extends('layouts.layout')

@section('title', $meta['title'] ?? 'My Payments')
@section('description', $meta['description'] ?? 'View your payment history and transaction details.')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="mb-0">My Payments</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Payments</li>
                            </ol>
                        </nav>
                    </div>

                    @if($payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Payment ID</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $payments->firstItem() + $index }}</td>
                                            <td>
                                                <code class="text-primary">{{ $payment->payment_id }}</code>
                                            </td>
                                            <td>
                                                <strong>{{ $payment->package_name }}</strong>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">
                                                    {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info text-capitalize">
                                                    {{ str_replace('_', ' ', $payment->payment_method ?? 'N/A') }}
                                                </span>
                                                @if($payment->international)
                                                    <br>
                                                    <small class="badge bg-warning">International</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->isSuccessful())
                                                    <span class="badge bg-success">Success</span>
                                                @elseif($payment->status === 'failed')
                                                    <span class="badge bg-danger">Failed</span>
                                                @else
                                                    <span class="badge bg-secondary text-capitalize">{{ $payment->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span title="{{ $payment->created_at->format('F j, Y \a\t g:i A') }}">
                                                    {{ $payment->created_at->format('M j, Y') }}
                                                </span>
                                                <br>
                                                <small class="text-muted">{{ $payment->created_at->format('g:i A') }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-success" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#paymentModal{{ $payment->id }}">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <p class="text-muted mb-0">
                                    Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} 
                                    of {{ $payments->total() }} payments
                                </p>
                            </div>
                            <div>
                                {{ $payments->links() }}
                            </div>
                        </div>

                        <!-- Payment Detail Modals -->
                        @foreach($payments as $payment)
                            <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="paymentModal{{ $payment->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg bg-white">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="paymentModal{{ $payment->id }}Label">
                                                Payment Details - {{ $payment->payment_id }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="fw-bold">Transaction Information</h6>
                                                    <table class="table table-borderless table-sm">
                                                        <tr>
                                                            <td><strong>Payment ID:</strong></td>
                                                            <td><code>{{ $payment->payment_id }}</code></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Order ID:</strong></td>
                                                            <td><code>{{ $payment->order_id }}</code></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Amount:</strong></td>
                                                            <td class="text-success fw-bold">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Status:</strong></td>
                                                            <td>
                                                                @if($payment->isSuccessful())
                                                                    <span class="badge bg-success">Success</span>
                                                                @else
                                                                    <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Payment Method:</strong></td>
                                                            <td class="text-capitalize">{{ str_replace('_', ' ', $payment->payment_method ?? 'N/A') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="fw-bold">Package Information</h6>
                                                    <table class="table table-borderless table-sm">
                                                        <tr>
                                                            <td><strong>Package:</strong></td>
                                                            <td>{{ $payment->package_name }}</td>
                                                        </tr>
                                                        @if($payment->package)
                                                            <tr>
                                                                <td><strong>Description:</strong></td>
                                                                <td>{{ Str::limit($payment->package->description, 100) }}</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td><strong>Purchase Date:</strong></td>
                                                            <td>{{ $payment->created_at->format('F j, Y \a\t g:i A') }}</td>
                                                        </tr>
                                                        @if($payment->contact)
                                                            <tr>
                                                                <td><strong>Contact:</strong></td>
                                                                <td>{{ $payment->contact }}</td>
                                                            </tr>
                                                        @endif
                                                        @if($payment->email)
                                                            <tr>
                                                                <td><strong>Email:</strong></td>
                                                                <td>{{ $payment->email }}</td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-credit-card fa-5x text-muted"></i>
                            </div>
                            <h4 class="text-muted">No Payments Found</h4>
                            <p class="text-muted mb-4">You haven't made any payments yet. Purchase a package to get started!</p>
                            <a href="{{ route('pages.buy_package') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Browse Packages
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        vertical-align: middle;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .badge {
        font-size: 0.75em;
    }
    
    code {
        font-size: 0.875em;
    }
    
    .btn-group .btn {
        border-radius: 0.375rem !important;
        margin-right: 0.25rem;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .modal-body table td {
        padding: 0.25rem 0.5rem;
    }
</style>
@endpush
