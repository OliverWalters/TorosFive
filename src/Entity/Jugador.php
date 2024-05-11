<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Jugador
 *
 * @ORM\Table(name="jugador")
 * @ORM\Entity
 */
class Jugador
{
    /**
     * @var string
     *
     * @ORM\Column(name="dniJugador", type="string", length=50, nullable=false)
     * @ORM\Id
     * 
     */
    private $dnijugador;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="posicion", type="string", length=50, nullable=true)
     */
    private $posicion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="nacimiento", type="date", nullable=true)
     */
    private $nacimiento;

    public function getDnijugador(): string {
        return $this->dnijugador;
    }

    public function getImagen(): ?string {
        return $this->imagen;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function getPosicion(): ?string {
        return $this->posicion;
    }

    public function getNacimiento(): ?\DateTime {
        return $this->nacimiento;
    }

    public function setDnijugador(string $dnijugador): void {
        $this->dnijugador = $dnijugador;
    }

    public function setImagen(?string $imagen): void {
        $this->imagen = $imagen;
    }

    public function setNombre(?string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setPosicion(?string $posicion): void {
        $this->posicion = $posicion;
    }

    public function setNacimiento(?\DateTime $nacimiento): void {
        $this->nacimiento = $nacimiento;
    }


}
