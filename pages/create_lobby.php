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
    <title>NEXUS | Create Lobby</title>
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

        /* Glass Panel */
        .glass-form {
            background: rgba(15, 15, 15, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Input Styling */
        .nexus-input {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .nexus-input:focus {
            outline: none;
            border-color: #cfff04;
            background: rgba(207, 255, 4, 0.05);
            box-shadow: 0 0 15px rgba(207, 255, 4, 0.1);
        }

        /* Custom Select Arrow */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
    </style>
</head>
<body class="text-white font-body min-h-screen flex flex-col items-center justify-center relative selection:bg-nexusGreen selection:text-black">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-[20%] left-[30%] w-[500px] h-[500px] bg-nexusGreen/5 blur-[120px] rounded-full"></div>
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

    <main class="w-full max-w-lg px-2 relative z-2 pt-3">

        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 border border-nexusGreen/30 bg-nexusGreen/5 px-3 py-1 rounded-full text-nexusGreen text-xs font-mono tracking-widest uppercase mb-4">
                <span class="w-2 h-2 rounded-full bg-nexusGreen animate-pulse"></span>
                Host a Match
            </div>
            <h1 class="text-5xl font-black font-heading uppercase text-white leading-none mb-2">Initialize <br> Lobby</h1>
            <p class="text-gray-500 text-sm">Set up your squad parameters and start recruiting.</p>
        </div>

        <form action="" method="POST" class="glass-form p-8 rounded-3xl relative overflow-hidden group">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-nexusGreen to-transparent opacity-50 group-hover:opacity-100 transition-opacity"></div>

            <div class="space-y-6">
                
                <div class="relative">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Select Game Protocol</label>
                    <div class="relative">
                        <select name="game_name" class="nexus-input w-full rounded-xl px-5 py-4 text-white font-heading font-bold uppercase text-lg cursor-pointer appearance-none">
                            <option value="" disabled selected class="bg-[#0a0a0a] text-gray-500">Choose Game...</option>
                            <option value="Valorant" class="bg-[#0a0a0a]">Valorant</option>
                            <option value="CS2" class="bg-[#0a0a0a]">Counter-Strike 2</option>
                        </select>
                        <div class="absolute right-5 top-1/2 transform -translate-y-1/2 pointer-events-none text-nexusGreen">
                            <i class="fa-solid fa-caret-down text-xl"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Lobby Title</label>
                    <input type="text" name="title" placeholder="e.g. Road to Immortal (Mic Only)" 
                        class="nexus-input w-full rounded-xl px-5 py-4 text-white placeholder-gray-600 font-medium focus:placeholder-white/20 transition-all">
                </div>

                <button type="submit" class="w-full bg-nexusGreen text-black font-heading font-black uppercase text-xl py-5 rounded-xl hover:bg-white hover:scale-[1.02] active:scale-[0.98] transition-all shadow-[0_0_20px_rgba(207,255,4,0.2)] mt-4 flex items-center justify-center gap-3">
                    <i class="fa-solid fa-rocket"></i> Launch Lobby
                </button>

            </div>
        </form>

    </main>

</body>
</html>