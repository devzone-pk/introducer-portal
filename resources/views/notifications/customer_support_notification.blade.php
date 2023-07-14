<a class="dropdown-item" href="javascript:void(0)"
   wire:click="markAsRead('{{ $notification->id }}','{{ '/customer-support/details/'.$notification->data['id']}}')">

    <i class="fas fa-bell"></i>
    Support team reply your complaint.
    <span class="text-1 text-muted d-block">{{ $notification->created_at->diffForHumans() }}</span></a>
