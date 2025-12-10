<?php 
session_start();
$isloggedin = false;
if(isset($_SESSION["id"])){
    $isloggedin = true;
}

?>
<?php 
if(!$isloggedin){?>

    <nav class="fixed w-full z-50 top-0 border-b border-white/5 bg-black/50 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6 md:px-8 h-20 flex items-center justify-between">
        
        <a href="index.php" class="flex items-center gap-3 group">
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
<?php }else { ?>

<nav class="fixed w-full z-50 top-0 border-b border-white/10 bg-[#0a0a0a]/90 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6 md:px-8 h-20 flex items-center justify-between">
        
        <div class="flex items-center gap-12">
            <a href="dashboard.php" class="flex items-center gap-2 group">
                <i class="fa-solid fa-network-wired text-nexusGreen text-2xl group-hover:animate-pulse"></i>
                <span class="text-2xl font-black font-heading tracking-widest text-white uppercase group-hover:text-nexusGreen transition-colors">Nexus</span>
            </a>

            <div class="hidden md:flex items-center gap-8 font-heading font-bold uppercase tracking-wider text-sm h-full">
                <a href="lobbies.php" class="text-white h-full flex items-center border-b-2 border-nexusGreen">
                    Lobby Finder
                </a>
                <a href="my-squad.php" class="text-gray-500 hover:text-white h-full flex items-center border-b-2 border-transparent hover:border-white/20 transition-colors">
                    My Squad
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
                        Commander
                    </p>
                    <div class="flex items-center justify-end gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-nexusGreen animate-pulse"></span>
                        <p class="text-[10px] font-mono uppercase text-gray-500">Online</p>
                    </div>
                </div>
                
                <div class="relative w-10 h-10">
                    <div class="absolute inset-0 rounded-lg border border-white/20 group-hover:border-nexusGreen transition-colors"></div>
                    <img src="https://i.pravatar.cc/150?u=user" class="w-full h-full rounded-lg object-cover p-0.5">
                </div>
            </div>
        </div>

    </div>
</nav>

<?php } ?>

