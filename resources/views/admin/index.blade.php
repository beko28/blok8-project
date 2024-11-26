@include('bovenenbeneden.header')

<div class="container">
    <h1>Gebruikersbeheer</h1>
    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Nieuwe gebruiker</a>
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning">Bewerken</a>
                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijderen</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('bovenenbeneden.footer')
