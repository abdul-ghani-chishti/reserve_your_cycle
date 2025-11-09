<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Chat</title>
</head>
<body>
<h3>Admin Chat Dashboard</h3>

<!-- Select which user to chat with -->
<label>Select User:</label>
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
