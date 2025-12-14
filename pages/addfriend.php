<?php
session_start();
$isloggedin = false;

if (!isset($_SESSION["id"])) {
    header("location: ../index.php");
    exit();
} else {
    $isloggedin = true;
}
require_once("../Class/Connexion.php");
require_once("../Class/User.php");
require_once("../Class/Friend.php");

$user = new User;
$friend = new Friend;
$user_info = $user->getUserInfo($_SESSION["id"]);


?>


<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS | Scout Players</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Rajdhani:wght@600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nexusGreen: '#cfff04',
                        nexusDark: '#0a0a0a',
                        nexusGray: '#171717',
                    },
                    fontFamily: {
                        heading: ['Rajdhani', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #050505;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #cfff04;
        }
    </style>
</head>

<body class="text-white font-body min-h-screen flex flex-col selection:bg-nexusGreen selection:text-black">

    <?php
    if (!$isloggedin) { ?>

        <nav class="fixed w-full z-50 top-0 border-b border-white/5 bg-black/50 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-6 md:px-8 h-20 flex items-center justify-between">

                <a href="../index.php" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-nexusGreen text-black flex items-center justify-center rounded skew-x-[-10deg] group-hover:bg-white transition-colors">
                        <i class="fa-solid fa-bolt text-xl skew-x-[10deg]"></i>
                    </div>
                    <span class="text-2xl font-black font-heading tracking-widest text-white uppercase group-hover:text-nexusGreen transition-colors">Nexus</span>
                </a>

                <div class="flex items-center gap-6 md:gap-8">
                    <a href="pages/login.php" class="text-gray-400 hover:text-white font-heading font-bold uppercase tracking-wider text-sm transition-colors">
                        Log In
                    </a>
                    <a href="pages/register.php" class="bg-white text-black px-6 py-2 rounded font-heading font-bold uppercase tracking-wider text-sm hover:bg-nexusGreen transition-colors shadow-[0_0_15px_rgba(255,255,255,0.3)] hover:shadow-[0_0_20px_rgba(207,255,4,0.6)]">
                        <span class="hidden md:inline">Initialize</span> Start
                    </a>
                </div>
            </div>
        </nav>
    <?php } else { ?>

        <nav class="fixed w-full z-50 top-0 border-b border-white/10 bg-[#0a0a0a]/90 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-6 md:px-8 h-20 flex items-center justify-between">

                <div class="flex items-center gap-12">
                    <a href="../index.php" class="flex items-center gap-2 group">
                        <i class="fa-solid fa-network-wired text-nexusGreen text-2xl group-hover:animate-pulse"></i>
                        <span class="text-2xl font-black font-heading tracking-widest text-white uppercase group-hover:text-nexusGreen transition-colors">Nexus</span>
                    </a>

                    <div class="hidden md:flex items-center gap-8 font-heading font-bold uppercase tracking-wider text-sm h-full">
                        <a href="lobbies.php" class="text-gray-500 hover:text-white h-full flex items-center border-b-2 border-transparent hover:border-white/20 transition-colors">
                            Lobby Finder
                        </a>
                        <a href="my-squad.php" class="text-white h-full flex items-center border-b-2 border-nexusGreen">
                            Scout Players
                        </a>
                        <a href="scrims.php" class="text-gray-500 hover:text-white h-full flex items-center border-b-2 border-transparent hover:border-white/20 transition-colors">
                            Scrims
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-6">

                    <a href="create_lobby.php" class="hidden md:flex items-center gap-2 border border-nexusGreen/30 bg-nexusGreen/5 text-nexusGreen px-4 py-2 rounded hover:bg-nexusGreen hover:text-black transition-all group shadow-[0_0_10px_rgba(207,255,4,0.1)] hover:shadow-[0_0_20px_rgba(207,255,4,0.4)]">
                        <i class="fa-solid fa-plus text-sm"></i>
                        <span class="font-heading font-bold uppercase text-sm tracking-wide">Create Lobby</span>
                    </a>

                    <button class="relative text-gray-400 hover:text-white transition-colors">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-[#0a0a0a]"></span>
                    </button>

                    <div class="h-8 w-[1px] bg-white/10 hidden md:block"></div>

                    <div class="flex items-center gap-3 cursor-pointer group">
                        <div class="text-right hidden md:block">
                            <p class="text-white font-heading font-bold leading-none text-lg group-hover:text-nexusGreen transition-colors">
                                <?= $user_info["user_name"] ?>
                            </p>
                            <div class="flex items-center justify-end gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-nexusGreen animate-pulse"></span>
                                <p class="text-[10px] font-mono uppercase text-gray-500">Online</p>
                            </div>
                        </div>
                        <a href="profile.php">
                            <div class="relative w-10 h-10">
                                <div class="absolute inset-0 rounded-lg border border-white/20 group-hover:border-nexusGreen transition-colors"></div>
                                <img src="<?= $user_info["profile_img"] ?>" class="w-full h-full rounded-lg object-cover p-0.5">
                            </div>
                        </a>

                    </div>
                </div>

            </div>
        </nav>

    <?php } ?>
    <main class="flex-grow pt-32 pb-16 px-6 relative z-10 w-full max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <div class="inline-flex items-center gap-2 border border-nexusGreen/30 bg-nexusGreen/5 px-3 py-1 rounded-full text-nexusGreen text-xs font-mono tracking-widest uppercase mb-4">
                    <span class="w-2 h-2 rounded-full bg-nexusGreen animate-pulse"></span>
                    Global Network
                </div>
                <h1 class="text-4xl md:text-5xl font-black font-heading uppercase text-white leading-none">
                    Scout New <span class="text-transparent bg-clip-text bg-gradient-to-r from-nexusGreen to-emerald-400">Teammates</span>
                </h1>
            </div>

            <form action="" method="GET" class="w-full md:w-auto flex gap-0 relative group">
                <div class="absolute inset-0 bg-nexusGreen/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <input type="text"  name="search" placeholder="Search Username or ID..." oninput="search_user(this.value)"
                    class="relative z-10 bg-[#0f0f0f] border border-white/10 border-r-0 rounded-l-lg px-6 py-4 w-full md:w-80 text-white focus:outline-none focus:border-nexusGreen transition-colors placeholder-gray-600 font-mono text-sm">
                <button type="submit" class="relative z-10 bg-white/5 border border-white/10 border-l-0 rounded-r-lg px-6 hover:bg-nexusGreen hover:text-black hover:border-nexusGreen transition-all text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <div class="flex gap-4 mb-8 overflow-x-auto pb-2">
            <button class="px-4 py-2 bg-nexusGreen text-black font-bold uppercase text-xs tracking-wider rounded border border-nexusGreen">All Games</button>
            <button class="px-4 py-2 bg-[#0f0f0f] text-gray-400 hover:text-white font-bold uppercase text-xs tracking-wider rounded border border-white/10 hover:border-white/30 transition-colors">Valorant</button>
            <button class="px-4 py-2 bg-[#0f0f0f] text-gray-400 hover:text-white font-bold uppercase text-xs tracking-wider rounded border border-white/10 hover:border-white/30 transition-colors">CS2</button>
            <button class="px-4 py-2 bg-[#0f0f0f] text-gray-400 hover:text-white font-bold uppercase text-xs tracking-wider rounded border border-white/10 hover:border-white/30 transition-colors">Apex Legends</button>
            <button class="px-4 py-2 bg-[#0f0f0f] text-gray-400 hover:text-white font-bold uppercase text-xs tracking-wider rounded border border-white/10 hover:border-white/30 transition-colors">League</button>
        </div>

        <div id="players_container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">


        </div>

    </main>

    <script>
    const players_container = document.getElementById("players_container");

    function renderUserList(users) {
        players_container.innerHTML = "";

        if (users.length === 0) {
            players_container.innerHTML = '<div class="col-span-full text-center text-gray-500 py-10">No agents found matching your query.</div>';
            return;
        }

        users.forEach(e => {
            const card = `
            <div class="group relative bg-[#0f0f0f] border border-white/10 rounded-2xl p-1 hover:border-nexusGreen/50 transition-all duration-300 hover:-translate-y-1">
                <div class="absolute inset-0 bg-nexusGreen/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <div class="relative bg-[#0a0a0a] rounded-xl p-5 h-full flex flex-col items-center text-center overflow-hidden">

                    <div class="absolute top-3 right-3 z-10">
                        <i class="fa-brands fa-steam text-gray-600 group-hover:text-nexusGreen transition-colors"></i>
                    </div>

                    <div class="w-20 h-20 rounded-xl mb-4 p-0.5 border-2 border-white/10 group-hover:border-nexusGreen transition-colors relative">
                        <img src="${e.profile_img}" class="w-full h-full rounded-[10px] object-cover">
                        <div class="absolute -bottom-2 -right-2 bg-purple-900 text-purple-200 text-[10px] font-bold px-2 py-0.5 rounded border border-purple-500 shadow-lg ">
                            ${e.rank}
                        </div>
                    </div>

                    <h3 class="text-xl font-heading font-bold text-white mb-1">${e.user_name}</h3>
                    <p class="text-xs text-gray-500 font-mono uppercase tracking-wide mb-4">
                        <i class="fa-solid fa-gamepad mr-1 text-nexusGreen"></i> ${e.game_playing}
                    </p>

                    <button onclick="sendinv(${e.id})" class="w-full bg-white/5 border border-white/10 text-white py-2 rounded font-heading font-bold uppercase text-sm tracking-wider hover:bg-nexusGreen hover:text-black hover:border-nexusGreen transition-all flex items-center justify-center gap-2 group-hover:shadow-[0_0_15px_rgba(207,255,4,0.3)]">
                        <i class="fa-solid fa-user-plus"></i> Scout Player
                    </button>
                </div>
            </div>`;
            
            players_container.insertAdjacentHTML("beforeend", card);
        });
    }

    function showUsers() {
        fetch("../Includes/fetch_users.php", {
            method: "POST"
        })
        .then(response => response.json())
        .then(data => {
            renderUserList(data); 
        });
    }
    
    showUsers();

    function search_user(username) {
        if(username.trim() === "") {
            showUsers();
            return;
        }

        let data = new FormData();
        data.append("username", username);
        data.append("myusername",'<?= $_SESSION["username"] ?>');

        fetch("../Includes/searchUser.php", {
            method: "POST",
            body: data
        })
        .then(response => response.json())
        .then(data => {
            renderUserList(data); 
        })
        .catch(error => console.error("Error:", error));
    }

    function sendinv(id) {
        let data = new FormData();
        data.append("receiver_id", id);

        fetch("../Includes/friend_request/add_friend.php", {
            method: "POST",
            body: data
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            alert(data);
        });
    }
</script>
</body>

</html>