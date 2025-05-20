import AlunniRiga from "./AlunniTr";
export default function AlunniTable(props) {
  const alunni = props.myArray;
  const caricaAlunni = props.caricaAlunni;
  return (
    <table border="1">
      {alunni.map((a) => (
        <AlunniRiga alunno={a} key={a.id} caricaAlunni={caricaAlunni} />
      ))}
    </table>
  );
}
