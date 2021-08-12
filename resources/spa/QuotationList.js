import { useState, useEffect } from "react";
import { Link } from "react-router-dom";

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

    function handleDeleteQuotationClick(event) {
        event.preventDefault();
        if (
            window.confirm(
                "Delete quotation for customer " + event.target.dataset.customer
            )
        ) {
            deleteQuotation(event.target.dataset.id);
        }
    }

    async function deleteQuotation(id) {
        const res = await fetch(`http://localhost:80/api/quotation/${id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        });

        requestQuotations();
    }

    useEffect(() => {
        requestQuotations();
    }, []);

    return (
        <div>
            <Link to={`/quotation`}>Add</Link>
            <table style={{ width: "100%" }}>
                <thead>
                    <tr>
                        <th />
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    {quotations.map((q) => (
                        <tr id={q.id} key={q.id}>
                            <td>
                                <Link to={`/quotation/${q.id}`}>Edit</Link>
                                &nbsp;
                                <a
                                    href="#"
                                    data-id={q.id}
                                    data-customer={q.customer}
                                    onClick={handleDeleteQuotationClick}
                                >
                                    Delete
                                </a>
                            </td>
                            <td>{q.customer}</td>
                            <td>{q.total}</td>
                            <td>{q.notes}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default QuotationList;
