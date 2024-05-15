<?php

namespace Akari\WorldSystem\utils;

use pocketmine\block\VanillaBlocks;
use pocketmine\world\ChunkManager;
use pocketmine\world\generator\Generator;
use pocketmine\math\Vector3;
use pocketmine\utils\Random;

class VoidGenerator extends Generator{

    /** @var ChunkManager */
    protected $world;
    /** @var Random */
    protected Random $random;

    /** @phpstan-ignore-next-line */
    public function __construct(array $settings = []) {

    }

    /**
     * @return string
     */
    public function getName(): string {
        return "void";
    }

    public function init(ChunkManager $world, Random $random): void {
        $this->world = $world;
        $this->random = $random;
    }

    public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void {
        $spawnLocation = $this->getSpawn();

        $spawnChunkX = $spawnLocation->getX() >> 4;
        $spawnChunkZ = $spawnLocation->getZ() >> 4;

        if ($chunkX === $spawnChunkX && $chunkZ === $spawnChunkZ) {
            $chunk = $this->world->getChunk($chunkX, $chunkZ);
            $x = $spawnLocation->getX() & 0x0f;
            $y = $spawnLocation->getY();
            $z = $spawnLocation->getZ() & 0x0f;
            $chunk->setFullBlock($x, $y, $z, VanillaBlocks::GRASS()->getTypeId());
        }
    }

    public function getSpawn(): Vector3 {
        return new Vector3(256, 65, 256);
    }

    public function populateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void {
    }

    public function getSettings(): array {
        return [];
    }

}