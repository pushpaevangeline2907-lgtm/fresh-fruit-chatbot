<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Fruit</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 450px;
            max-width: 95%;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        h1 { text-align: center; color: #7b1fa2; }

        label { font-weight: bold; color: #444; }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #ddd;
            border-radius: 9px;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 20px;
            border: 0;
            border-radius: 10px;
            background: #8e24aa;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #7b1fa2;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>✏️ Edit Fruit</h1>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('fruits.update', $fruit) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Fruit Name:</label>

        <input
            type="text"
            name="fruit_name"
            placeholder="Enter fruit name"
            value="{{ old('fruit_name', $fruit->fruit_name) }}"
            required
        >

        <br><br>

        <label>Price / 1 KG:</label>

        <input
            type="number"
            name="price_per_kg"
            step="0.01"
            min="0"
            placeholder="Enter price"
            value="{{ old('price_per_kg', $fruit->price_per_kg) }}"
            required
        >

        <button type="submit">💾 Update Fruit</button>

    </form>

    <a class="back" href="{{ route('fruits.index') }}">← View Fruits</a>

</div>

</body>
</html>
