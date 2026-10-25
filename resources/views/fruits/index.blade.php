<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fresh Fruit Shop - Fruits</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 950px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        h1 { text-align: center; color: #7b1fa2; }

        .subtitle { text-align: center; color: #666; margin-bottom: 25px; }

        .top {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search { display: flex; gap: 8px; }

        input {
            padding: 11px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        button, .add-btn, .bot-btn, .edit-btn {
            border: 0;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            display: inline-block;
        }

        button, .add-btn { background: #8e24aa; color: white; }
        .bot-btn { background: #3949ab; color: white; }
        .edit-btn { background: #7b1fa2; color: white; }

        .delete-btn {
            background: #d32f2f;
            color: white;
            border: 0;
            padding: 9px 12px;
            border-radius: 7px;
            cursor: pointer;
        }

        .success {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        table { width: 100%; border-collapse: collapse; }

        th {
            background: #8e24aa;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td { padding: 13px; border-bottom: 1px solid #eee; }

        .price { font-weight: bold; color: #6a1b9a; }

        .actions { display: flex; gap: 7px; }
        .actions form { margin: 0; }

        .empty { text-align: center; padding: 25px; color: #777; }
    </style>
</head>
<body>

<div class="container">

    <h1>🍎 Fresh Fruit Shop</h1>

    <div class="subtitle">🍓 View Fruits &amp; Fruit Management</div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="top">

        <form class="search" action="{{ route('fruits.index') }}" method="GET">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search fruit">
            <button type="submit">🔍 Search</button>
        </form>

        <div>
            <a class="add-btn" href="{{ route('fruits.create') }}">➕ Add Fruit</a>
            <a class="bot-btn" href="{{ route('bot.index') }}">🤖 Customer Bot</a>
        </div>

    </div>

    @if($fruits->count() > 0)

        <table>
            <tr>
                <th>No.</th>
                <th>Fruit</th>
                <th>Price / KG</th>
                <th>Actions</th>
            </tr>

            @foreach($fruits as $fruit)
                <tr>
                    <td>{{ $fruit->id }}</td>
                    <td>{{ $fruit->fruit_name }}</td>
                    <td class="price">₹{{ number_format($fruit->price_per_kg, 2) }} / KG</td>
                    <td>
                        <div class="actions">

                            <a class="edit-btn" href="{{ route('fruits.edit', $fruit) }}">✏️ Edit</a>

                            <form
                                action="{{ route('fruits.destroy', $fruit) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this fruit?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn" type="submit">🗑️ Delete</button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

    @else

        <div class="empty">No fruit found in the database.</div>

    @endif

</div>

</body>
</html>
