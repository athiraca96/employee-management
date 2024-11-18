<div class="d-flex justify-content-start">
    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>

    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
    </form>
</div>
