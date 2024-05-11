<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Evento
 *
 * @ORM\Table(name="evento")
 * @ORM\Entity
 */
class Evento
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevento;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    public function getIdevento(): int {
        return $this->idevento;
    }

    public function getImagen(): ?string {
        return $this->imagen;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function getFecha(): ?\DateTime {
        return $this->fecha;
    }

    public function getDescripcion(): ?string {
        return $this->descripcion;
    }

    public function setImagen(?string $imagen): void {
        $this->imagen = $imagen;
    }

    public function setNombre(?string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setFecha(?\DateTime $fecha): void {
        $this->fecha = $fecha;
    }

    public function setDescripcion(?string $descripcion): void {
        $this->descripcion = $descripcion;
    }


}
