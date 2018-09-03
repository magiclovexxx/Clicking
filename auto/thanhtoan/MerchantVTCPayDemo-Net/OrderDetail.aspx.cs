using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebSitePayment
{
    public partial class OrderDetail : System.Web.UI.Page
    {
        // Đây là trang demo thanh toán đơn hàng có đầy đủ thông số 

        protected void Page_Load(object sender, EventArgs e)
        {
            if (IsPostBack) return;
            txtOrderID.Text = DateTime.Now.ToString("yyyyMMddHHmmss");
        }

        protected void Button1_Click(object sender, EventArgs e)
        {
            try
            {
                string Security_Key = ConfigurationManager.AppSettings["SecretKey"];
                                
                string website_id = txtWebsiteID.Text.Trim();
                string amount = txtTotalAmount.Text.Trim();
                string currency = ddlCurrency.SelectedValue;
                string receiver_account = txtReceiveAccount.Text.Trim();
                string reference_number = txtOrderID.Text.Trim();

                string transaction_type = txtTransactionType.Text;
                string language = ddlLanguage.SelectedValue;
                string url_return = txtUrlReturn.Text;
                string payment_type = txtPaymentType.Text;
                string bill_to_email = txtEmail.Text;
                string bill_to_phone = txtPhone.Text;
                string bill_to_address = txtAddressLine1.Text;
                string bill_to_address_city = txtCity.Text;
                string bill_to_surname = txtSurName.Text;
                string bill_to_forename = txtForeName.Text;


                Dictionary<string, object> paramQueryList = new Dictionary<string, object>()
                {
                    {"website_id", website_id},
                    {"amount",amount},
                    {"currency",currency},
                    {"receiver_account",receiver_account},
                    {"reference_number",reference_number},
                    {"transaction_type",transaction_type},
                    {"language",language},
                    {"url_return",url_return},
                    {"payment_type",payment_type},
                    {"bill_to_email",bill_to_email},
                    {"bill_to_phone",bill_to_phone},
                    {"bill_to_address",bill_to_address},
                    {"bill_to_address_city",bill_to_address_city},
                    {"bill_to_surname",bill_to_surname},
                    {"bill_to_forename",bill_to_forename}        
                };

                string plaintext = string.Empty;
                string listparam = string.Empty;

                String[] sortedKeys = paramQueryList.Keys.ToArray();
                Array.Sort(sortedKeys);

                foreach (String key in sortedKeys)
                {
                    plaintext += string.Format("{0}{1}", plaintext.Length > 0 ? "|" : string.Empty, paramQueryList[key]);
                    if (new string[] { "url_return", "bill_to_surname", "bill_to_forename", "bill_to_address", "bill_to_address_city" }.Contains(key))
                        listparam += string.Format("{0}={1}&", key, Server.UrlEncode(paramQueryList[key].ToString()));
                    else
                        listparam += string.Format("{0}={1}&", key, paramQueryList[key].ToString());
                }

                string textSign = string.Format("{0}|{1}", plaintext, Security_Key);
                string signature = Security.SHA256encrypt(textSign);

                NLogLogger.LogInfo("Textsign:" + textSign
                    + Environment.NewLine + "signature:" + signature);

                listparam = string.Format("{0}signature={1}", listparam, signature);
                string urlRedirect = string.Format("{0}?{1}", ddlEnvinroment.SelectedValue, listparam);

                NLogLogger.LogInfo("urlFull: " + urlRedirect);

                Response.Redirect(urlRedirect, false);
            }
            catch (Exception ex)
            {
                Label1.Text = ex.ToString();
                NLogLogger.Info(ex.ToString());
            }

        }

        protected void ddlEnvinroment_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (ddlEnvinroment.SelectedItem.Text == "Sandbox")
            {
                txtReceiveAccount.Text = "0963465816";
                txtWebsiteID.Text = "453";
            }
            else if (ddlEnvinroment.SelectedItem.Text == "Live")
            {
                txtReceiveAccount.Text = "0986699480";
                txtWebsiteID.Text = "627";
            }
        }
    }
}