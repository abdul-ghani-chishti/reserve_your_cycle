@extends('admin.layout.master')

@section('title', 'Dashboard')
<style>
    /* --- Chat Container Styles --- */
    .chat-container {
        max-width: 500px;
        margin: 40px auto;
        padding: 20px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .chat-header {
        font-size: 1.6rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    /* --- Dropdown Styling --- */
    .user-select-container {
        margin-bottom: 20px;
        text-align: left;
    }

    .user-select-container label {
        font-weight: 600;
        color: #555;
        display: block;
        margin-bottom: 5px;
    }

    #userSelect {
        width: 60%;
        border-radius: 8px;
        padding: 10px 12px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    #userSelect:hover, #userSelect:focus {
        border-color: #007bff;
        background-color: #fff;
        outline: none;
        box-shadow: 0 0 4px rgba(0,123,255,0.3);
    }

    /* --- Chat Box Styling --- */
    #chat-box {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background-color: #fafafa;
    }

    #messages {
        height: 250px;
        overflow-y: auto;
        border-bottom: 1px solid #ddd;
        padding: 10px;
        background: #fff;
        border-radius: 6px;
        margin-bottom: 12px;
    }

    #messageInput {
        width: 78%;
        border-radius: 6px;
        border: 1px solid #ccc;
        padding: 8px;
    }

    #sendBtn {
        width: 18%;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 8px;
        font-weight: 600;
        transition: 0.2s;
    }

    #sendBtn:hover {
        background-color: #0056b3;
    }
</style>
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('admin.inc.messages')
            <div class="content-body">
                <div class="card">
                    <div class="card-content text-center">
                        <div class="card-body">
                            <h1 class="mb-5">Live Chat System ...</h1>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <label class="mr-3">Select User:</label>
                                    <select id="userSelect">
                                        @foreach($users as $user)
                                            <option value="user_{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    <div id="chat-box" style="width: 400px; border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
                                        <div id="messages" style="height: 250px; overflow-y: scroll; border-bottom: 1px solid #ddd; margin-bottom: 10px;"></div>
                                        <input type="text" id="messageInput" placeholder="Type message" style="width: 80%;">
                                        <button id="sendBtn">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">

@endsection
<!-- Select which user to chat with -->


<script type="module">
    // ---------------- FIREBASE IMPORTS ----------------
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
    import {
        getFirestore, collection, addDoc, query, orderBy, onSnapshot, serverTimestamp
    } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-firestore.js";

    // ---------------- FIREBASE CONFIG ----------------
    const firebaseConfig = {
        apiKey: "AIzaSyBL8YQagNC6Olp-OJqVrswOqnK1Ku83mFU",
        authDomain: "reserve-cycle.firebaseapp.com",
        projectId: "reserve-cycle",
        storageBucket: "reserve-cycle.firebasestorage.app",
        messagingSenderId: "48529419941",
        appId: "1:48529419941:web:dedffae850f4a8087de74c",
        measurementId: "G-QKMM3G87QR"
    };

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);

    // ---------------- CHAT VARIABLES ----------------
    // firestore
    const ADMIN_ID = "admin_1";
    let CURRENT_USER_ID = document.getElementById("userSelect").value;

    // ---------------- FUNCTIONS ----------------
    async function sendMessage() {
        const messageText = document.getElementById("messageInput").value.trim();
        if (!messageText) return;

        const chatRef = collection(db, "chats", CURRENT_USER_ID, "messages");
        await addDoc(chatRef, {
            sender_id: ADMIN_ID,
            receiver_id: CURRENT_USER_ID,
            text: messageText,
            timestamp: serverTimestamp(),
        });

        document.getElementById("messageInput").value = "";
    }

    function listenForMessages() {
        const chatRef = collection(db, "chats", CURRENT_USER_ID, "messages");
        const q = query(chatRef, orderBy("timestamp"));
        onSnapshot(q, snapshot => {
            const messagesDiv = document.getElementById("messages");
            messagesDiv.innerHTML = "";
            snapshot.forEach(doc => {
                const msg = doc.data();
                const messageElem = document.createElement("div");
                messageElem.textContent = (msg.sender_id === ADMIN_ID ? "You: " : "User: ") + msg.text;
                messagesDiv.appendChild(messageElem);
            });
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
    }

    // ---------------- EVENT HANDLERS ----------------
    document.getElementById("sendBtn").addEventListener("click", sendMessage);

    document.getElementById("userSelect").addEventListener("change", e => {
        CURRENT_USER_ID = e.target.value;
        listenForMessages();
    });

    // Start listening for default selected user
    listenForMessages();
    //firestore ends
</script>
</body>
</html>
