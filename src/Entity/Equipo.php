<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Equipo
 *
 * @ORM\Table(name="equipo", indexes={@ORM\Index(name="dniEntrenador", columns={"dniEntrenador"})})
 * @ORM\Entity
 */
class Equipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEquipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idequipo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="categoria", type="string", length=50, nullable=true)
     */
    private $categoria;

    /**
     * @var \Entrenador
     *
     * @ORM\ManyToOne(targetEntity="Entrenador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dniEntrenador", referencedColumnName="dniEntrenador")
     * })
     */
    private $dnientrenador;

    public function getIdequipo(): int {
        return $this->idequipo;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function getCategoria(): ?string {
        return $this->categoria;
    }

    public function getDnientrenador(): \Entrenador {
        return $this->dnientrenador;
    }

    public function setNombre(?string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setCategoria(?string $categoria): void {
        $this->categoria = $categoria;
    }

    public function setDnientrenador(\Entrenador $dnientrenador): void {
        $this->dnientrenador = $dnientrenador;
    }


}
