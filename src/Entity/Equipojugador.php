<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Equipojugador
 *
 * @ORM\Table(name="equipojugador", indexes={@ORM\Index(name="idEquipo", columns={"idEquipo"}), @ORM\Index(name="dniJugador", columns={"dniJugador"})})
 * @ORM\Entity
 */
class Equipojugador
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Equipo
     *
     * @ORM\ManyToOne(targetEntity="Equipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEquipo", referencedColumnName="idEquipo")
     * })
     */
    private $idequipo;

    /**
     * @var \Jugador
     *
     * @ORM\ManyToOne(targetEntity="Jugador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dniJugador", referencedColumnName="dniJugador")
     * })
     */
    private $dnijugador;

    public function getId(): int {
        return $this->id;
    }

    public function getIdequipo(): \Equipo {
        return $this->idequipo;
    }

    public function getDnijugador(): \Jugador {
        return $this->dnijugador;
    }

    public function setIdequipo(\Equipo $idequipo): void {
        $this->idequipo = $idequipo;
    }

    public function setDnijugador(\Jugador $dnijugador): void {
        $this->dnijugador = $dnijugador;
    }

    public function __toString(): string
{
    return (string) $this->id;
}
}
