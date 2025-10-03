<?php

namespace Database\Seeders;

use App\Models\RuneterraWord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuneterraWordsSeeder extends Seeder
{
    public function run(): void
    {
        $words = [
            "AATROX", "AHRI", "AKALI", "AKSHAN", "ALISTAR", "AMUMU", "ANIVIA", "ANNIE", "APHELIOS", "ASHE",
            "AURELION SOL", "AURORA", "AZIR", "BARD", "BEL'VETH", "BLITZCRANK", "BRAND", "BRAUM", "BRIAR", "CAITLYN",
            "CAMILLE", "CASSIOPEIA", "CHO'GATH", "CORKI", "DARIUS", "DIANA", "DR. MUNDO", "DRAVEN", "EKKO", "ELISE",
            "EVELYNN", "EZREAL", "FIDDLESTICKS", "FIORA", "GALIO", "GANGPLANK", "GAREN", "GNAR", "GRAGAS", "GRAVES",
            "GWEN", "HECARIM", "HEIMERDINGER", "ILLAOI", "IRELIA", "IVERN", "JANNA", "JARVAN IV", "JHIN", "JINX",
            "KAI'SA", "KARMA", "KARTHUS", "KASSADIN", "KATARINA", "KAYLE", "KENNEN", "KHA'ZIX", "KINDRED", "KLED",
            "K'SANTE", "KOG'MAW", "LEBLANC", "LEE SIN", "LEONA", "LILLIA", "LISSANDRA", "LUCIAN", "LULU", "LUX",
            "MALPHITE", "MISS FORTUNE", "MILIO", "MORDEKAISER", "MORGANA", "NAMI", "NASUS", "NAUTILUS", "NEEKO",
            "NILAH", "OLAF", "ORIANA", "PANTHEON", "POPPY", "PYKE", "QIYANA", "RAKAN", "RAMMUS", "REK'SAI", "RENATA GLASC",
            "RENEKTON", "RIVEN", "RUMBLE", "RYZE", "SAMIRA", "SEJUANI", "SENNA", "SETT", "SHACO", "SHEN", "SIVIR",
            "SKARNER", "SONA", "SORAKA", "SWAIN", "SYLAS", "TAHM KENCH", "TALIYAH", "TEEMO", "THRESH", "TRISTANA",
            "TRUNDLE", "TRYNDAMERE", "TWISTED FATE", "TWITCH", "UDYR", "URGOT", "VARUS", "VAYNE", "VEIGAR", "VEL'KOZ",
            "VI", "VIEGO", "VIKTOR", "VLADIMIR", "VOLIBEAR", "WARWICK", "WUKONG", "XAYAH", "YASUO", "YONE",
            "YUUMI", "ZAC", "ZED", "ZERI", "ZILEAN", "ZOE", "ZYRA", "DEMACIA", "NOXUS", "IONIA", "PILTOVER", "ZAUN", "SHURIMA", "FRELJORD", "TARGON", "ICATHIA"
        ];

        foreach ($words as $word) {
            RuneterraWord::firstOrCreate(
                ['name' => $word],
                ['max_attempts' => 6]
            );
        }
    }
}
