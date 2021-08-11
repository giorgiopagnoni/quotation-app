import { useState, useEffect } from "react";

const QuotationList = () => {
    const [quotations, setQuotations] = useState([]);

    async function requestQuotations() {
        const res = await fetch(`http://localhost:80/api/quotation`, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        });

        const json = await res.json();
        setQuotations(json.data);
    }

    useEffect(() => {
        requestQuotations();
    }, []);

    const tableRows = quotations.map((q) => (
        <tr id={q.id} key={q.id}>
            <td>{q.customer}</td>
            <td>{q.total}</td>
            <td>{q.notes}</td>
        </tr>
    ));

    return (
        <table style={{ width: "100%" }}>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>{tableRows}</tbody>
        </table>
    );
};

export default QuotationList;
