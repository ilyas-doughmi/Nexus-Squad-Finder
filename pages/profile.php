<?php
session_start();
$isloggedin = false;

if (!isset($_SESSION["id"])) {
    header("location: ../index.php");
    exit();
}
else{
    $isloggedin = true;
}
require_once("../Class/Connexion.php");
require_once("../Class/User.php");
$user = new User;
$user_info = $user->getUserInfo($_SESSION["id"]);

?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS | Profile</title>
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
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
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

        .glass-panel {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* 3D Effect */
        .perspective-container { perspective: 1000px; }
        .tilted-card {
            transform: rotateY(-10deg) rotateX(5deg);
            transform-style: preserve-3d;
            box-shadow: -20px 20px 50px rgba(0,0,0,0.5);
            transition: transform 0.3s ease;
        }
        .perspective-container:hover .tilted-card {
            transform: rotateY(0deg) rotateX(0deg);
        }
    </style>
</head>
<body class="text-white font-body min-h-screen flex flex-col selection:bg-nexusGreen selection:text-black">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-nexusGreen/5 blur-[150px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-purple-600/10 blur-[150px] rounded-full"></div>
    </div>

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
                    <a href="addfriend.php" class="text-gray-500 hover:text-white h-full flex items-center border-b-2 border-transparent hover:border-white/20 transition-colors">
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
                        <p class="font-heading font-bold leading-none text-lg text-nexusGreen transition-colors">
                            <?= $user_info["user_name"] ?>
                        </p>
                        <div class="flex items-center justify-end gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-nexusGreen animate-pulse"></span>
                            <p class="text-[10px] font-mono uppercase text-gray-500">Online</p>
                        </div>
                    </div>
                    <a href="profile.php">
                        <div class="relative w-10 h-10">
                            <div class="absolute inset-0 rounded-lg border  border-nexusGreen transition-colors"></div>
                            <img src="<?= $user_info["profile_img"] ?>" class="w-full h-full rounded-lg object-cover p-0.5">
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </nav>

<?php } ?>

    <main class="flex-grow pt-32 pb-16 px-6 relative z-10 w-full max-w-7xl mx-auto">
        
        <div class="grid lg:grid-cols-12 gap-12">

            <div class="lg:col-span-4 perspective-container flex flex-col gap-6">
                
                <div class="tilted-card relative w-full aspect-[3/4] rounded-3xl overflow-hidden border border-white/10 bg-[#0f0f0f]">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover opacity-40 mix-blend-overlay">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent"></div>
                    </div>

                    <div class="absolute inset-0 p-8 flex flex-col justify-end">
                        <div class="relative z-10">
                            <div class="w-24 h-24 rounded-2xl p-1 bg-white/5 border border-white/10 mb-6 backdrop-blur-md">
                                <img src="<?= $user_info["profile_img"] ?>" class="w-full h-full rounded-xl object-cover">
                            </div>

                            <h1 class="text-4xl font-black font-heading uppercase text-white leading-none mb-2">
                                <?= $user_info["user_name"]  ?>
                            </h1>
                            
                            <div class="flex items-center gap-3 mb-6">
                                <span class="px-2 py-1 bg-nexusGreen text-black text-xs font-bold font-mono uppercase rounded">
                                    <?= $user_info["rank"] ?>
                                </span>
                                <span class="text-gray-400 text-xs font-mono uppercase tracking-wider">
                                    <i class="fa-solid fa-crosshairs mr-1 text-nexusGreen"></i> Controller
                                </span>
                            </div>

                            <div class="grid grid-cols-3 gap-2 border-t border-white/10 pt-4">
                                <div>
                                    <p class="text-gray-500 text-[10px] uppercase font-bold">Matches</p>
                                    <p class="text-xl font-heading font-bold text-white">842</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-[10px] uppercase font-bold">Win Rate</p>
                                    <p class="text-xl font-heading font-bold text-nexusGreen">58%</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-[10px] uppercase font-bold">K/D</p>
                                    <p class="text-xl font-heading font-bold text-white">1.4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <button class="w-full bg-white text-black font-heading font-bold uppercase py-4 rounded hover:bg-nexusGreen transition-all tracking-wider shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                        Edit Profile
                    </button>
                    <div class="flex gap-3">
                        <button class="flex-1 border border-white/10 bg-white/5 py-3 rounded text-sm font-bold uppercase hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-discord mr-2"></i> Link
                        </button>
                        <button class="flex-1 border border-white/10 bg-white/5 py-3 rounded text-sm font-bold uppercase hover:bg-white/10 transition-colors">
                            <i class="fa-brands fa-steam mr-2"></i> Link
                        </button>
                    </div>
                </div>

            </div>


            <div class="lg:col-span-8 space-y-8">
                
                <div>
                    <div class="flex justify-between items-end mb-6">
                        <h3 class="text-xl font-heading font-bold uppercase tracking-wider border-l-4 border-nexusGreen pl-3">Online Squad</h3>
                        <span class="text-xs text-gray-500 uppercase font-mono cursor-pointer hover:text-white transition">Manage Friends</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <div class="bg-[#0f0f0f] border border-white/5 p-4 rounded-xl flex items-center gap-4 hover:border-nexusGreen/50 transition-colors group cursor-pointer relative overflow-hidden">
                            <div class="absolute right-0 top-0 w-16 h-full bg-gradient-to-l from-nexusGreen/5 to-transparent"></div>
                            
                            <div class="relative">
                                <div class="w-12 h-12 rounded-lg bg-gray-800 overflow-hidden">
                                    <img src="https://i.pravatar.cc/150?u=s1mple" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-nexusGreen rounded-full border-2 border-[#0f0f0f] animate-pulse"></div>
                            </div>

                            <div>
                                <h4 class="font-heading font-bold text-white group-hover:text-nexusGreen transition-colors">S1mple</h4>
                                <p class="text-[10px] text-gray-400 uppercase font-mono tracking-wide">
                                    <i class="fa-solid fa-gamepad mr-1 text-nexusGreen"></i> Playing CS2
                                </p>
                            </div>

                            <button class="ml-auto w-8 h-8 rounded bg-white/5 hover:bg-nexusGreen hover:text-black transition flex items-center justify-center">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>

                        <div class="bg-[#0f0f0f] border border-white/5 p-4 rounded-xl flex items-center gap-4 hover:border-nexusGreen/50 transition-colors group cursor-pointer">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-lg bg-gray-800 overflow-hidden">
                                    <img src="https://i.pravatar.cc/150?u=tenz" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-nexusGreen rounded-full border-2 border-[#0f0f0f]"></div>
                            </div>

                            <div>
                                <h4 class="font-heading font-bold text-white group-hover:text-nexusGreen transition-colors">TenZ</h4>
                                <p class="text-[10px] text-gray-400 uppercase font-mono tracking-wide">In Lobby (2/5)</p>
                            </div>

                            <button class="ml-auto w-8 h-8 rounded bg-white/5 hover:bg-nexusGreen hover:text-black transition flex items-center justify-center">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            </button>
                        </div>

                        <div class="bg-[#0f0f0f] border border-white/5 p-4 rounded-xl flex items-center gap-4 hover:border-white/20 transition-colors group cursor-pointer opacity-70 hover:opacity-100">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-lg bg-gray-800 overflow-hidden grayscale">
                                    <img src="https://i.pravatar.cc/150?u=shroud" class="w-full h-full object-cover">
                                </div>
                            </div>

                            <div>
                                <h4 class="font-heading font-bold text-gray-400 group-hover:text-white transition-colors">Shroud</h4>
                                <p class="text-[10px] text-gray-600 uppercase font-mono tracking-wide">Offline • 2h ago</p>
                            </div>
                        </div>

                        <div class="bg-[#0f0f0f] border border-dashed border-white/10 p-4 rounded-xl flex items-center justify-center gap-2 hover:border-nexusGreen hover:text-nexusGreen text-gray-500 transition-all cursor-pointer h-full">
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="font-heading font-bold uppercase text-sm tracking-wide">Add Friend</span>
                        </div>

                    </div>
                </div>

                <div class="bg-white/5 rounded-2xl p-6 border border-white/5">
                    <h4 class="text-sm font-mono uppercase text-gray-400 font-bold mb-4">Pending Requests <span class="bg-nexusGreen text-black px-1.5 rounded ml-2" id="request_count"></span></h4>
                    
                    <div id="friendr_container" class="space-y-3">
                        
                  
                    </div>
                </div>

            </div>
        </div>

    </main>
<script>
    function getPendingRequests(id)
    {
        const friendr_container = document.getElementById("friendr_container");
        const request_count = document.getElementById("request_count");
        fetch("../Includes/friend_request/fetch_requests.php",{
            method : "POST"
        })
        .then(res=>res.json())
        .then(data=> {
            request_count.textContent = data.length;
            friendr_container.innerHTML = "";
            data.forEach(e => {
                card = `<div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="${e.profile_img}" class="w-8 h-8 rounded bg-gray-700">
                                <span class="font-heading font-bold text-white">${e.user_name}</span>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="acceptFriend(${e.id})" class="px-3 py-1 bg-nexusGreen text-black text-xs font-bold uppercase rounded hover:bg-white transition">Accept</button>
                                <button onclick="rejectFriend(${e.id})" class="px-3 py-1 bg-white/10 text-white text-xs font-bold uppercase rounded hover:bg-red-500 transition">Decline</button>
                            </div>
                        </div>`
                        friendr_container.insertAdjacentHTML("beforeend",card);
            });
        })
    }
    getPendingRequests(<?= $_SESSION["id"] ?>)

    function acceptFriend(id){
        let form = new FormData();
        form.append("sender_id",id);
        form.append("status","accepted");
        fetch("../Includes/friend_request/accept_friend.php",{
            method: "POST",
            body: form 
        });
    }
    function rejectFriend(id){
    let form = new FormData();
        form.append("sender_id",id);
        form.append("status","rejected");
        fetch("../Includes/friend_request/accept_friend.php",{
            method: "POST",
            body: form 
        });
    }
</script>
</body>
</html>