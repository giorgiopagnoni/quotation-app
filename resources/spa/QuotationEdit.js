import { useState, useEffect } from "react";
import { Link, useHistory } from "react-router-dom";

const QuotationEdit = (props) => {
    const [customer, setCustomer] = useState("");
    const [total, setTotal] = useState(0);
    const [notes, setNotes] = useState("");
    const [errors, setErrors] = useState("");

    let history = useHistory();

    useEffect(() => {
        requestQuotation();
    }, []);

    function populateQuotation(q) {
        setCustomer(q.customer);
        setTotal(q.total);
        setNotes(q.notes ? q.notes : "");
    }

    async function requestQuotation() {
        const res = await fetch(
            `http://localhost:80/api/quotation/${props.match.params.id}`,
            {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }
        );

        if (res.status !== 200) {
            history.push("/");
            return;
        }

        const json = await res.json();
        populateQuotation(json.data);
    }

    async function updateQuotation() {
        const res = await fetch(
            `http://localhost:80/api/quotation/${props.match.params.id}`,
            {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
                body: JSON.stringify({
                    customer,
                    total,
                    notes,
                }),
            }
        );

        const json = await res.json();

        if (res.status === 200) {
            populateQuotation(json.data);
        } else if (res.status === 422) {
            //  todo: actual errors from server
            setErrors("Validation error");
        } else {
            setErrors("Something went wrong");
        }
    }

    return (
        <div>
            <span style={{ color: "red" }}>{errors}</span>
            <form
                onSubmit={(e) => {
                    e.preventDefault();
                    updateQuotation();
                }}
            >
                <label htmlFor="customer">
                    Customer
                    <input
                        id="customer"
                        onChange={(e) => setCustomer(e.target.value)}
                        value={customer}
                        placeholder="Customer"
                        disabled
                    />
                </label>
                <br />
                <label htmlFor="total">
                    Total Price
                    <input
                        id="total"
                        onChange={(e) => setTotal(e.target.value)}
                        value={total}
                        type="number"
                        placeholder="Total"
                    />
                </label>
                <br />
                <label htmlFor="notes">
                    Notes
                    <textarea
                        id="notes"
                        onChange={(e) => setNotes(e.target.value)}
                        value={notes}
                        placeholder="Notes"
                    />
                </label>
                <br />
                <button>Update</button>
                <br/>
                <Link to="/">Back to List</Link>
            </form>
        </div>
    );
};

export default QuotationEdit;
