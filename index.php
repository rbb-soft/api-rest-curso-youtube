<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>HTTP Client</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1e1e1e;
            color: #d4d4d4;
            height: 100vh;
            display: flex;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .panel {
            padding: 20px;
            height: 100%;
            overflow: auto;
        }

        .left-panel {
            width: 40%;
            border-right: 1px solid #333;
        }

        .right-panel {
            width: 60%;
            padding-left: 30px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            background-color: #2d2d2d;
            border: 1px solid #444;
            color: #d4d4d4;
            border-radius: 4px;
        }

        button {
            background-color: #007acc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #005a9e;
        }

        .headers-list {
            margin-bottom: 20px;
        }

        .header-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .response {
            background-color: #1a1a1a;
            padding: 15px;
            border-radius: 4px;
            max-height: 80vh;
            overflow-y: auto;
            white-space: pre-wrap;
            font-family: monospace;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="panel left-panel">
            <h2>Request</h2>
            <form id="requestForm">
                <select id="method">
                    <option>GET</option>
                    <option>POST</option>
                    <option>PUT</option>
                    <option>DELETE</option>
                </select>
                <input type="text" id="url" placeholder="URL" required>
                
                <div class="headers-list">
                    <h3>Headers</h3>
                    <div class="header-item">
                        <input type="text" class="header-key" placeholder="Key">
                        <input type="text" class="header-value" placeholder="Value">
                    </div>
                </div>
                <button type="button" onclick="addHeader()">Add Header</button>

                <h3>Body</h3>
                <textarea id="body" placeholder="Request body (JSON)" class="hidden"></textarea>

                <button type="submit">Send</button>
            </form>
        </div>
        <div class="panel right-panel">
            <h2>Response</h2>
            <div id="response" class="response"></div>
        </div>
    </div>

    <script>
    async function sendRequest(e) {
        e.preventDefault();
        
        const url = document.getElementById('url').value;
        const method = document.getElementById('method').value;
        const body = method !== 'GET' ? document.getElementById('body').value : null;
        
        // Construir headers
        const headers = {};
        document.querySelectorAll('.header-item').forEach(item => {
            const key = item.querySelector('.header-key').value;
            const value = item.querySelector('.header-value').value;
            if (key && value) headers[key] = value;
        });

        try {
            const response = await fetch(url, {
                method: method,
                headers: headers,
                body: body
            });

            let responseBody;
            const contentType = response.headers.get('content-type');
            
            if (contentType?.includes('application/json')) {
                try {
                    const jsonData = await response.json();
                    responseBody = JSON.stringify(jsonData, null, 2);
                } catch (jsonError) {
                    responseBody = "Error: Respuesta JSON inválida";
                }
            } else {
                responseBody = await response.text();
            }

            document.getElementById('response').textContent = 
                `Status: ${response.status} ${response.statusText}\n\n` + responseBody;
        } catch (error) {
            document.getElementById('response').textContent = 'Error: ' + error.message;
        }
    }

    document.getElementById('requestForm').addEventListener('submit', sendRequest);
</script>

</body>
</html>