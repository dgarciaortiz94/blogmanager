<?php

namespace App\DataHelper;

use App\Entity\Comment;
use App\Entity\Podcast;
use App\Entity\User;


class StatisticsHelper
{
    public function getStatistics($doctrine)
    {
        $userRepository          = $doctrine->getRepository(User::class);
        $podcastRepository       = $doctrine->getRepository(Podcast::class);
        $commentRepository       = $doctrine->getRepository(Comment::class);

        $users = $userRepository->findAll();
        $podcasts = $podcastRepository->findAll();
        $comments = $commentRepository->findAll();

        $registeredUsersNumber   = count($users);
        $activeUsersNumber       = count(array_filter($users, function($i) { return $i->getIsActive() == true; }));
        $inactiveUsersNumber     = count(array_filter($users, function($i) { return $i->getIsActive() == false; }));

        $podcastsNumber          = count($podcasts);
        $activePodcastsNumber    = count(array_filter($podcasts, function($i) { return $i->getIsActive() == true; }));
        $inactivePodcastsNumber  = count(array_filter($podcasts, function($i) { return $i->getIsActive() == false; }));

        $commentsNumber          = count($comments);
        $commentsActiveNumber    = count(array_filter($comments, function($i) { return $i->getIsActive() == true; }));
        $commentsInactiveNumber  = count(array_filter($comments, function($i) { return $i->getIsActive() == false; }));

        $statistics = [
            "USUARIOS" => [
                "Usuarios registrados"   =>  $registeredUsersNumber,
                "Usuarios activos"       =>  $activeUsersNumber,
                "Usuarios bloqueados"     =>  $inactiveUsersNumber
            ],
            "PODCASTS" => [
                "Podcasts"          =>  $podcastsNumber,
                "Podcasts activos"    =>  $activePodcastsNumber,
                "Podcasts bloqueados"  =>  $inactivePodcastsNumber
            ],
            "COMENTARIOS" => [
                "Comentarios"          =>  $commentsNumber,
                "Comentarios activos"    =>  $commentsActiveNumber,
                "Comentarios bloqueados"  =>  $commentsInactiveNumber
            ]
        ];

        return $statistics;
    }

}