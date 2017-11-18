<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('building_category')->truncate();

        $categories = [
            "Musician | Poet | Producer | Songwriter | Web Designer | Entrepreneur | Creativist.",
            "Songwriter | Musician",
            "Portrait Artist",
            "Spoken Word Artist | Rapper | Song Writer | Producer",
            "Artist | Musician | Photographer | Filmmaker | Designer | Creative Media Tutor",
            "Photographer",
            "Sculptor",
            "Painter",
            "Musician | Sound Engineer",
            "Musician (Specialising in Church Ceremony Music)", 
            "Music | Music Technology Teacher",
            "Poet | Author",
            "Guitar | Flute Player | Actor",
            "Creative Design Studio",
            "Award Winning Architectural Services & Project Management",
            "Painter | Graphic Designer",
            "Figurative Artist (Specialising in Etchings, Felting Scultptures and Glass Painting)",
            "Photographer",
            "Photographer",
            "Musician",
            "Circus & Hula Hoop Facilitator | Performer",
            "App Developer",
            "Painter",
            "Digital Content Creator",
            "Photographer",
            "Textile Artist | Designer",
            "Painter | Calligrapher",
            "Dance Artist",
            "Fine Art",
            "Technician | Audio Visual | Projection Mapping | Lights and Sound",
            "Painter | Printer | Install | Animate Digitally | Perform",
            "Photographer | Screen Printer",
            "Stage Manager (but have done various roles on stage and screen)",
            "Visual Artist",
            "Dance Movement Psychotherapist | Dance facilitator",
            "Web Designer",
            "Content Editor",
            "Graphic Designer | Digital Artist",
            "Actress | Drama Facilitator",
            "Stage Manager",
            "Model | Photographer (film) | Embroider | Painter | Ballerina",
            ];

        foreach ($categories as $category){
            \App\Models\Category::create([
               'name' => $category
            ]);
        }

    }
}
