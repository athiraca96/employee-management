<div class="d-flex justify-content-start">
    <a href="{{ route('employees.edit', $user->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>

    <form action="{{ route('employees.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
    </form>
</div>