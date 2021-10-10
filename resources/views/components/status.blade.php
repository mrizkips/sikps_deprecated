<div class="badge bg-{{ $status == '0' ? 'secondary' : ($status == '1' ? 'success text-white' : 'danger text-white') }}">{{ config('constant.status')[$status] }}</div>
