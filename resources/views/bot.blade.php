<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fresh Fruit Shop - Customer Bot</title>
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
            padding: 20px;
        }

        .container {
            width: 520px;
            max-width: 100%;
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        h1 { text-align: center; color: #7b1fa2; margin-top: 0; }

        .subtitle { text-align: center; color: #666; margin-bottom: 15px; }

        .chat-box {
            height: 340px;
            overflow-y: auto;
            background: #faf5fc;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .msg {
            max-width: 82%;
            padding: 10px 14px;
            border-radius: 14px;
            line-height: 1.4;
            word-wrap: break-word;
        }

        .bot { background: #e1bee7; color: #333; align-self: flex-start; }
        .user { background: #8e24aa; color: white; align-self: flex-end; }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 12px 0;
            max-height: 90px;
            overflow-y: auto;
        }

        .chip {
            background: #f3e5f5;
            color: #7b1fa2;
            border: 1px solid #ce93d8;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            cursor: pointer;
        }

        .input-row { display: flex; gap: 8px; }

        input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 9px;
        }

        button.send {
            padding: 12px 18px;
            border: 0;
            border-radius: 9px;
            background: #8e24aa;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .manage {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #7b1fa2;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>🤖 Fruit Shop Bot</h1>

    <div class="subtitle">Type a fruit name, or "fruit name price"</div>

    <div class="chat-box" id="chatBox">
        <div class="msg bot">
            👋 Welcome to Fresh Fruit Shop! Type a fruit name (for example
            <b>Mango</b>) or <b>Mango price</b> to check availability and price.
        </div>
    </div>

    <div class="chips" id="chips"></div>

    <div class="input-row">
        <input type="text" id="messageInput" placeholder="Type a fruit name..." autocomplete="off">
        <button class="send" id="sendBtn" type="button">Send</button>
    </div>

    <a class="manage" href="{{ route('fruits.index') }}">🍓 Manage Fruits</a>

</div>

<script>
    const fruitData = @json($fruitData);
    const chatUrl = @json(route('bot.chat'));
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    const chatBox = document.getElementById('chatBox');
    const input = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const chips = document.getElementById('chips');

    function addMessage(html, type, isHtml) {
        const div = document.createElement('div');
        div.className = 'msg ' + type;
        if (isHtml) { div.innerHTML = html; } else { div.textContent = html; }
        chatBox.appendChild(div);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    async function sendMessage(text) {
        text = (text || '').trim();
        if (!text) return;

        addMessage(text, 'user', false);
        input.value = '';

        try {
            const response = await fetch(chatUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({ message: text })
            });

            if (!response.ok) throw new Error('Request failed');

            const data = await response.json();
            addMessage(data.reply, 'bot', true);
        } catch (e) {
            addMessage('⚠️ Something went wrong. Please try again.', 'bot', false);
        }
    }

    fruitData.forEach(function (fruit) {
        const chip = document.createElement('span');
        chip.className = 'chip';
        chip.textContent = fruit.fruit_name;
        chip.addEventListener('click', function () {
            sendMessage(fruit.fruit_name);
        });
        chips.appendChild(chip);
    });

    sendBtn.addEventListener('click', function () { sendMessage(input.value); });

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') { e.preventDefault(); sendMessage(input.value); }
    });
</script>

</body>
</html>
