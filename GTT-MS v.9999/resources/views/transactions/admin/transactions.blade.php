@extends('layouts.admin_app')

@section('content')




<div class=container-fluid>
  <br><h3>Transactions</h3>
  <table data-order='[[ 1, "desc" ]]' id="transaction-tbl" class="display table table-hover table-bordered border-primary">
  <thead>
    <tr class="table-warning">
      <th scope="col">Date:</th>
      <th scope="col">Driver:</th>
      <th scope="col">Boundary:</th>
      <th scope="col">Bond:</th>
      <th scope="col">Expenses:</th>
      <th scope="col">Status:</th>
      <th scope="col">Remarks:</th>
      <th scope="col">Action:</th>
    </tr>
  </thead>

  <tbody>
  @foreach ($transactions as $transaction)
  <tr>
    <td>{{$transaction->date}}</td>
    <td>{{$transaction->name}}</td>
    <td>{{ $transaction->boundary}}</td>
    <td>{{ $transaction->bond}}</td>
    <td>{{ $transaction->expenses}}</td>
    <td>
      @if($transaction->status == "For Verification")
      <span class="badge bg-danger">{{ $transaction->status}}</span>
      @elseif($transaction->status == "Verified")
      <span class="badge bg-success">{{ $transaction->status}}</span>
      @elseif($transaction->status == "For Updating")
      <span class="badge bg-warning">{{ $transaction->status}}</span>
      @elseif($transaction->status == "Resubmitted")
      <span class="badge bg-info">{{ $transaction->status}}</span>
      @endif
    </td>
    <td>{{ $transaction->remarks}}</td>
    <td>
      @if($transaction->status != "Verified")
      <a class="btn btn-outline-warning" id="updateStatsBtn" data_id="{{$transaction->id}}">Update</a>
      @endif
    </td>
    
  </tr>
  @endforeach
  </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="statusForm">
          <input type="hidden" class="form-control" name="id" id="id">
          <input type="hidden" class="form-control" name="verified_by" id="verified_by" value="{{Auth::user()->name }}">
          
            <label class="form-label"> Update Status</label>
            <select class="form-select" aria-label="Default select example" name="status" id="status">
              @foreach($status as $stats)
              <option value="{{$stats}}">{{$stats}}</option>
              @endforeach
            </select>
            <label class="form-label"> Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control" rows="2"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="saveUpdate" class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>


@include('transactions/transaction_script')
@endsection
