@extends('admin.layout.master')

@section('title', 'Live Chat')

@section('content')
    <style>
        /* ----------- LAYOUT ----------- */
        .chat-wrapper {
            display: flex;
            height: 75vh;
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* ----------- USER LIST ----------- */
        .user-list {
            width: 30%;
            background: #f7f8fa;
            border-right: 1px solid #ddd;
            display: flex;
            flex-direction: column;
        }

        .user-list h4 {
            text-align: center;
            padding: 15px 0;
            margin: 0;
            background: #007bff;
            color: #fff;
            font-size: 1.2rem;
        }

        .user-item {
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-item:hover, .user-item.active {
            background: #e8f0ff;
        }

        /* ----------- CHAT AREA ----------- */
        .chat-area {
            width: 70%;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 12px 16px;
            background: #007bff;
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
        }

        #messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
            background: #f9f9f9;
        }

        /* Message bubbles */
        .message {
            max-width: 70%;
            padding: 10px 14px;
            margin-bottom: 10px;
            border-radius: 16px;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .message.admin {
            background: #007bff;
            color: #fff;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }

        .message.user {
            background: #eaeaea;
            color: #333;
            border-bottom-left-radius: 0;
        }

        /* Input Area */
        .input-area {
            display: flex;
            border-top: 1px solid #ddd;
            padding: 10px;
            background: #fff;
        }

        #messageInput {
            flex-grow: 1;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-right: 10px;
            outline: none;
        }

        #sendBtn {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        #sendBtn:hover {
            background: #0056b3;
        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            @include('admin.inc.messages')
            <div class="content-body">
                <h1 class="text-center mb-3">💬 Live Chat System</h1>
                <div class="chat-wrapper">

                    <!-- LEFT USER LIST -->
                    <div class="user-list">
                        <h4>Users</h4>
                        @foreach($users as $user)
                            <div class="user-item" data-user-id="user_{{ $user->id }}">
                                {{ $user->name }}
                            </div>
                        @endforeach
                    </div>

                    <!-- RIGHT CHAT AREA -->
                    <div class="chat-area">
                        <div class="chat-header" id="chatHeader">Select a user to start chatting</div>
                        <div id="messages"></div>
                        <div class="input-area">
                            <input type="text" id="messageInput" placeholder="Type a message..." disabled>
                            <button id="sendBtn" disabled>Send</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="module">
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

        // ---------------- VARIABLES ----------------
        const ADMIN_ID = "admin_1";
        let CURRENT_USER_ID = null;
        const messagesDiv = document.getElementById("messages");
        const chatHeader = document.getElementById("chatHeader");
        const input = document.getElementById("messageInput");
        const sendBtn = document.getElementById("sendBtn");

        // ---------------- FUNCTIONS ----------------
        function listenForMessages() {
            if (!CURRENT_USER_ID) return;
            const chatRef = collection(db, "chats", CURRENT_USER_ID, "messages");
            const q = query(chatRef, orderBy("timestamp"));
            onSnapshot(q, snapshot => {
                messagesDiv.innerHTML = "";
                snapshot.forEach(doc => {
                    const msg = doc.data();
                    const messageElem = document.createElement("div");
                    messageElem.classList.add("message", msg.sender_id === ADMIN_ID ? "admin" : "user");
                    messageElem.textContent = msg.text;
                    messagesDiv.appendChild(messageElem);
                });
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            });
        }

        async function sendMessage() {
            if (!CURRENT_USER_ID || !input.value.trim()) return;
            const chatRef = collection(db, "chats", CURRENT_USER_ID, "messages");
            await addDoc(chatRef, {
                sender_id: ADMIN_ID,
                receiver_id: CURRENT_USER_ID,
                text: input.value.trim(),
                timestamp: serverTimestamp(),
            });
            input.value = "";
        }

        // ---------------- EVENT HANDLERS ----------------
        document.querySelectorAll(".user-item").forEach(item => {
            item.addEventListener("click", () => {
                document.querySelectorAll(".user-item").forEach(i => i.classList.remove("active"));
                item.classList.add("active");
                CURRENT_USER_ID = item.getAttribute("data-user-id");
                chatHeader.textContent = "Chat with " + item.textContent.trim();
                input.disabled = false;
                sendBtn.disabled = false;
                listenForMessages();
            });
        });

        sendBtn.addEventListener("click", sendMessage);
        input.addEventListener("keypress", e => {
            if (e.key === "Enter") sendMessage();
        });
    </script>
@endsection
