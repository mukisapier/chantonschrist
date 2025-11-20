<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = [
            [
                'number' => 1,
                'title' => 'Grand Dieu, nous te bénissons',
                'type' => 2, // French
                'content' => "1. Grand Dieu, nous te bénissons,\nNous célébrons tes louanges !\nÉternel, nous t'exaltons,\nDe concert avec les anges,\n— Et prosternés devant Toi,\nNous t'adorons, ô grand Roi ! — (bis)\n\n2. Les saints et les bienheureux,\nLes trônes et les puissances,\nToutes les vertus des cieux,\nDisent tes magnificences,\n— Proclamant dans leurs concerts,\nLe grand Dieu de l'Univers. — (bis)\n\n3. Saint, saint, saint, est l'Éternel,\nLe Seigneur, Dieu des armées ;\nSon pouvoir est immortel ;\nSes œuvres partout semées\n— Font éclater sa grandeur,\nSa majesté, sa splendeur. — (bis)\n\n4. Sauve ton peuple, Seigneur,\nEt bénis ton héritage ;\nQue ta gloire et ta splendeur\nSoient à jamais son partage,\n— Conduis-le par ton amour\nJusqu'au céleste séjour ! — (bis)\n\n5. Gloire soit au Saint-Esprit !\nGloire soit à Dieu le Père !\nGloire soit à Jésus-Christ,\nNotre Sauveur, notre Frère !\n— Son immense charité\nDure à perpétuité. — (bis)",
                'author' => 'C.V. N° 1',
            ],
            [
                'number' => 1,
                'title' => "E'YESU mshindaji wa Golgotha",
                'type' => 1, // Swahili
                'content' => "1. E' Yesu Mshindaji wa Golgotha, twakusifu!\nBendera ya mapenzi ni Alama ya Kushinda.\nUlichukua dhambi zetu juu ya msalaba wako.\nTwakuhimidi, Bwana na Mfalme! Haleluya!  \n\n2. Twashinda na zaidi ya Kushinda Kati' yote Kwa\ndamu yako, Yesu, na Watuinua moyo .\nKatika vita na jaribu Twaipeleka kwa Furaha\nBendera yako nzuri ya Kushinda kati vita. \n\n3. Mbinguni Mkombozi ni Mkuu mwenye sifa.\nAliondoa dhambi kwa Kutufilia wote.\nMwana-Kondoo wake Mungu, Umestahili\nkupokea Uweza, utukufu na Heshima.\nHeleluya!",
                'author' => 'Lewi Petrus 1913',
            ],
        ];

        foreach ($songs as $song) {
            Song::create($song);
        }
    }
}
